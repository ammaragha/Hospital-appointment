import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AdminGuard } from './auth/admin.guard';
import { AuthGuard } from './auth/auth.guard';
import { LoginComponent } from './auth/login/login.component';
import { RegisterComponent } from './auth/register/register.component';
import { AdminResComponent } from './pages/admin-res/admin-res.component';
import { WelocmeComponent } from './pages/home/welocme/welocme.component';
import { ReservationsComponent } from './pages/reservations/reservations.component';



const routes: Routes = [
  { path: '', component: WelocmeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'reservation', component: ReservationsComponent, canActivate: [AuthGuard] },
  { path: 'admin/reservations', component: AdminResComponent, canActivate: [AuthGuard, AdminGuard] }
];

@NgModule({
  declarations: [],
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]

})
export class AppRoutingModule { }
