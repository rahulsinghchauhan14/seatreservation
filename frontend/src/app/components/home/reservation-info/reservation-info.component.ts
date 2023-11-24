import { Component, OnInit } from '@angular/core';
import { DataShareService } from 'src/app/services/data-share.service';
import { RestApiService } from 'src/app/services/rest-api.service'; 

@Component({
  selector: 'app-reservation-info',
  templateUrl: './reservation-info.component.html', 
  styleUrls: ['./reservation-info.component.css']
})
export class ReservationInfoComponent implements OnInit {

  
    public seatLeft:any = {};
    public AllSeats:any = {}; 
    constructor(private rest: RestApiService, private dataShare: DataShareService){}

    ngOnInit(): void {
      this.getRemainingSeats();
      this.getAllSeats(); 
      this.dataShare.seatNo.subscribe(()=>{
        this.getRemainingSeats();
        this.getAllSeats(); 
      });
    }

    getRemainingSeats(){
      this.rest.getRemainingSeats().subscribe(res => {
        this.seatLeft = res;
      });
    }

    getAllSeats(){
      this.rest.getAllSeats().subscribe(res => {
        this.AllSeats = res;
      });
    }
}
