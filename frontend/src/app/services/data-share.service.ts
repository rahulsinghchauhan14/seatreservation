import { Injectable } from '@angular/core';
import { BehaviorSubject, Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DataShareService {

  public seatNo = new Subject();
  
  constructor() { }
}
