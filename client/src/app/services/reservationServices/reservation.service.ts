import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Ireserve } from 'src/app/interfaces/ireserve';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ReservationService {

  host = environment.apiUrl;

  constructor(
    private __http: HttpClient
  ) { }


  reserve(data: Ireserve): Observable<any> {
    return this.__http.post(`${this.host}/reserve`, data);
  }

  getAll():Observable<any>{
    return this.__http.get(`${this.host}/reservations`);
  }

  today():Observable<any>{
    return this.__http.get(`${this.host}/today-reservations`);
  }

  getAllForUser():Observable<any>{
    return this.__http.get(`${this.host}/user/reservations`);
  }

  getWaitedForUser():Observable<any>{
    return this.__http.get(`${this.host}/user/waited-reservations`);
  }

}
