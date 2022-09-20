import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Ireserve } from 'src/app/interfaces/ireserve';
import { ReservationService } from 'src/app/services/reservationServices/reservation.service';

@Component({
  selector: 'app-admin-res',
  templateUrl: './admin-res.component.html',
  styleUrls: ['./admin-res.component.css']
})
export class AdminResComponent implements OnInit {
  reservations: any = {};
  constructor(
    private __reservService: ReservationService,
    private __toastr: ToastrService
  ) {
  }

  ngOnInit(): void {
    this.today();
  }

  today() {
    this.__reservService.today().subscribe({
      next: res => {
        this.reservations = res.data
        console.log(this.reservations);

      },
      error: err => {
        this.__toastr.error('something wrong')
      }
    })
  }

  all() {
    this.__reservService.getAll().subscribe({
      next: res => {
        this.reservations = res.data
        console.log(this.reservations);

      },
      error: err => {
        this.__toastr.error('something wrong')
      }
    })
  }

}
