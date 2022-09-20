import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class TokenService {
  host = environment.apiUrl
  private issuer = {
    login: this.host + 'token/create',
    register: this.host + '/register',
  };

  constructor() { }


  handleData(token: any) {
    localStorage.setItem('token', token);
  }

  getToken() {
    return localStorage.getItem('token');
  }

  // Verify the token
  isValidToken() {
    const token = this.getToken();
    // if (token) {
    //   const payload = this.payload(token);
    //   if (payload) {
    //     return Object.values(this.issuer).indexOf(payload.iss) > -1
    //       ? true
    //       : false;
    //   }
    // } else {
    //   return false;
    // }

    return token ? true : false;
  }

  // payload(token: any) {
  //   const jwtPayload = token.split('.')[1];
  //   return JSON.parse(atob(jwtPayload));
  // }

  // User state based on valid token
  isLoggedIn() {
    return this.isValidToken();
  }

  // Remove token
  removeToken() {
    localStorage.removeItem('token');
  }
}
