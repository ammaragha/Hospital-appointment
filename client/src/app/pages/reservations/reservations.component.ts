import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { ISpecial } from 'src/app/interfaces/ispecial';
import { ReservationService } from 'src/app/services/reservationServices/reservation.service';
import { SpecialitiesService } from 'src/app/services/reservationServices/specialities.service';

@Component({
  selector: 'app-reservations',
  templateUrl: './reservations.component.html',
  styleUrls: ['./reservations.component.css']
})
export class ReservationsComponent implements OnInit {

  reserveForm: FormGroup;
  public specialities: any = [];
  public errors: any = [];

  reservations:any={};
  re: boolean = true;
  constructor(
    private __specialService: SpecialitiesService,
    private __reserveService: ReservationService,
    private __toastr: ToastrService
  ) {
    this.reserveForm = new FormGroup({
      special_id: new FormControl('', Validators.required),
      time: new FormControl('', Validators.required),
      date: new FormControl('', Validators.required)
    })
  }

  ngOnInit(): void {
    this.getSpecialties();
  }



  getSpecialties() {
    this.__specialService.getAll().subscribe({
      next: (res: any) => {
        this.specialities = res.data;
      },
      error: (err) => {
        this.__toastr.error('something wrong with getting specialites');
      }
    })
  }


  reserve() {
    let myform = this.reserveForm

    if (myform.valid) {
      this.__reserveService.reserve(myform.value).subscribe({
        next: (res: any) => {
          this.__toastr.success(res.message)
        },
        error: (err: any) => {
          this.errors = err.error.errors;
          this.__toastr.error('something went wrong')
        }
      })
    } else {
      this.__toastr.error('fill fields please');
    }
  }

  openRe() {
    this.re = true
  }

  closeRe() {
    this.re = false
  }

  all(){
    this.closeRe()
    this.__reserveService.getAllForUser().subscribe({
      next:(res:any)=>{
        this.reservations = res.data
      }
    })
  }

  waited(){
    this.closeRe()

    this.__reserveService.getWaitedForUser().subscribe({
      next:(res:any)=>{
        this.reservations = res.data
      }
    })
  }

}
