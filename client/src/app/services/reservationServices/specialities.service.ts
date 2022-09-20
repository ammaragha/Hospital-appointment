import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ISpecial } from 'src/app/interfaces/ispecial';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SpecialitiesService {

  host = environment.apiUrl;
  constructor(
    private __http:HttpClient
  ) { }

  getAll():Observable<any>{
    return this.__http.get<ISpecial>(`${this.host}/specialities`);
  }
}
