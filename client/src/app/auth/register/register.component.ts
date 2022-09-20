import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthStateService } from 'src/app/services/authService/auth-state.service';
import { AuthService } from 'src/app/services/authService/auth.service';
import { TokenService } from 'src/app/services/authService/token.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  public registerForm: FormGroup;

  public errors = [];

  constructor(
    private __router: Router,
    private __toastr: ToastrService,
    private __authService: AuthService,
    private __tokenService: TokenService,
    private __authStateService: AuthStateService
  ) {
    this.registerForm = new FormGroup({
      email: new FormControl('', Validators.email),
      password: new FormControl('', Validators.required),
      name: new FormControl('', Validators.required),
      gender: new FormControl('', Validators.required),
      phone: new FormControl(''),
      birthday: new FormControl('')
    })

  }

  ngOnInit(): void {
    this.__authStateService.userAuthState.subscribe(val => {
      if (val) {
        this.__router.navigate(['reservation']);
      }
    })
  }

  register() {
    console.log('asdasd');

    let myform = this.registerForm;
    console.log(myform.value);

    if (myform.valid) {
      const observer = {
        next: (res: any) => {
          console.log(res);
          this.responseHandler(res.data)
          this.__router.navigate(['reservation']);
        },
        error: (err: any) => {
          this.errors = err.error;
        },
        complete: () => {
          myform.reset();
          this.__authStateService.setAuthState(true);
        }
      }
      this.__authService.register(myform.value).subscribe(observer);
    }
  }


  // Handle response
  responseHandler(data: any) {
    this.__tokenService.handleData(data.token);
  }


}
