import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { RestApiService } from 'src/app/services/rest-api.service';
import { DataShareService } from 'src/app/services/data-share.service';

@Component({
  selector: 'app-reservation-form',
  templateUrl: './reservation-form.component.html', 
  styleUrls: ['./reservation-form.component.css']
})
export class ReservationFormComponent implements OnInit {
 
  reservationData: any;
  errorMessage: string | null = null;
  seatMatch: number = 0;

  constructor(private rest: RestApiService, private dataShare: DataShareService) { }

  ngOnInit(): void {
    this.getSeats();
  }
 
  reservationForm = new FormGroup({ 
    noOfSeat: new FormControl('', [Validators.required, Validators.pattern('^[1-7]$')])
  })

  onSubmit() {
    this.errorMessage = null;
    if (this.reservationForm.valid) {
      const postData = { ...this.reservationForm.value }; 
      this.getSeats();
      console.log(this.seatMatch);
      if(Number(postData.noOfSeat) <= this.seatMatch){
        this.rest.seatReservation(postData).subscribe(
          (res) => {
            this.reservationData = res.data;
            this.reservationForm.reset();
            this.dataShare.seatNo.next(null);
            console.log('Reservation Data:', this.reservationData);
          },
          (error) => { 
            console.error('Error:', error); 
            this.errorMessage = 'An error occurred. Please try again later.';
          });
      }else{
        this.errorMessage = `Please enter a number of seats less than or equal to ${this.seatMatch}`;
      }
    }
  }

  getSeats(){
    this.rest.getRemainingSeats().subscribe(
      (res) => { 
        this.seatMatch = res?.data; 
      },
      (error) => { 
        console.error('Error:', error); 
        this.errorMessage = 'An error occurred. Please try again later.';
      });
  }
}
