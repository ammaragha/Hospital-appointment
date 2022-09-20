import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from "@angular/common/http";
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { IUser } from 'src/app/interfaces/iuser';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  host = environment.apiUrl;
  constructor(private __http: HttpClient) {

  }


  login(data: IUser): Observable<any> {
    return this.__http.post(`${this.host}/token/create`, data);
  }


  register(data: IUser): Observable<any> {
    return this.__http.post(`${this.host}/register`, data);
  }

  user(): Observable<any> {
    return this.__http.get(`${this.host}/user`);
  }
}
