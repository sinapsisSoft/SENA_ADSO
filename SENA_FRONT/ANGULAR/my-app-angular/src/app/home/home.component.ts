import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HousingLocationComponent } from '../housing-location/housing-location.component';
import { HousingLocation } from '../housing-location';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CommonModule, HousingLocationComponent],
  template: `
  <section>
    <form class="row">
    
<div class="input-group mb-3">
  
  <input type="text" class="form-control" placeholder="Filter by city" aria-label="Filter by city" >
  <button class="btn btn-primary" type="button" >Search</button>
</div>
    </form>
  </section>
  <section class="results">
  <app-housing-location [housingLocation]="housingLocation"></app-housing-location>
  </section>
`,
  styleUrls: ['./home.component.css'],
})

export class HomeComponent {
  readonly baseUrl = 'https://angular.dev/assets/images/tutorials/common';
  housingLocation: HousingLocation = {
    id: 9999,
    name: 'Test Home',
    city: 'Test city',
    state: 'ST',
    photo: `${this.baseUrl}/example-house.jpg`,
    availableUnits: 99,
    wifi: true,
    laundry: false,
  };
}
