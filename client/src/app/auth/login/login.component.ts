import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthStateService } from 'src/app/services/authService/auth-state.service';
import { AuthService } from 'src/app/services/authService/auth.service';
import { TokenService } from 'src/app/services/authService/token.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  //myvars
  public submitted: boolean = false;
  public errors: any = [];
  loginForm: FormGroup;

  constructor(
    private __authService: AuthService,
    private __toastr: ToastrService,
    private __router: Router,
    private __tokenServie: TokenService,
    private __authStateService: AuthStateService
  ) {
    this.loginForm = new FormGroup({
      email: new FormControl('', Validators.email),
      password: new FormControl('', Validators.required)
    });
  }

  ngOnInit(): void {
    this.__authStateService.userAuthState.subscribe(val=>{
      if(val){
        this.__router.navigate(['reservation']);
      }
    })
  }

  login() {
    let myform = this.loginForm;
    this.submitted = true;
    if (myform.valid) {
      const observer = {
        next: (res: any) => {
          this.responseHandler(res.data);
        },
        error: (err: any) => {
          this.__toastr.error(err.error.message);
        },
        complete:()=>{
          myform.reset();
          this.__authStateService.setAuthState(true);
          this.__router.navigate(['reservation']);
        }
      }
      this.__authService.login(myform.value).subscribe(observer);
    }
  }


  // Handle response
  responseHandler(data:any) {
    this.__tokenServie.handleData(data.token);
  }

}
