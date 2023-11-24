import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RestApiService {

  protected APIURL = environment?.apiUrl ?? '';
  
  constructor(private http: HttpClient) { 
  }

  private get(url: string){
    return this.http.get(`${this.APIURL}/${url}`);
  }

  private post(url: string, body: any){
    return this.http.post(`${this.APIURL}/${url}`, body);
  }

  // get no of Remaining seats which are not booked yet
  public getRemainingSeats(): Observable<any>{
    return this.get('remainingSeats');
  }

  // get all seats information
  public getAllSeats(){
    return this.get('allSeats');
  }

  // booked seats 
  public seatReservation(body:any): Observable<any>{
    return this.post('booking',body);
  }

  
}
