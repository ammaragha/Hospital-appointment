import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/authService/auth.service';

@Injectable({
  providedIn: 'root'
})
export class AdminGuard implements CanActivate {
  constructor(
    private __authService:AuthService,
    private __router:Router
  ){

  }
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):any{
    this.__authService.user().subscribe({
      next:(res:any)=>{
        let user = res.data.user
        console.log(user.role);
        if(user.role == 'admin')
        return true;
        else
        return false;
      },
      error:err=>this.__router.navigate(['reservation'])
    })
  }
  
}
