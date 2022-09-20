import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { IUser } from 'src/app/interfaces/iuser';
import { AuthStateService } from 'src/app/services/authService/auth-state.service';
import { AuthService } from 'src/app/services/authService/auth.service';
import { TokenService } from 'src/app/services/authService/token.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  isLogged!: boolean;
  user!: IUser;
  isAdmin=false;
  constructor(
    private __authStateService: AuthStateService,
    private __router: Router,
    private __tokenService: TokenService,
    private __authService: AuthService
  ) { }

  ngOnInit() {
    this.__authStateService.userAuthState.subscribe((val) => {
      this.isLogged = val;
      if (this.isLogged) {
        this.__authService.user().subscribe({
          next: (res: any) => {
            this.user = res.data.user
            if(this.user.role == 'admin'){
              this.isAdmin=true
            }
          },
          error: (error: any) => this.__router.navigate(['login']),
        })
      }
    })
  }

  signout() {
    console.log('logout');

    this.__authStateService.setAuthState(false);
    this.__tokenService.removeToken();
    this.__router.navigate(['login']);
  }


}
