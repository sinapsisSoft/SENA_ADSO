import { Component, Input } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HousingLocation } from '../housing-location'

@Component({
  selector: 'app-housing-location',
  standalone: true,
  imports: [CommonModule],
  template: `
 <div class="col order-last m-1">
  <div class="card " style="width: 100%">
  <img [src]="housingLocation.photo" class="card-img-top img-fluid" style="height:200px" alt="Exterior photo of {{ housingLocation.name }}">
  <div class="card-body">
    <h5 class="card-title">{{ housingLocation.name }}</h5>
    <p class="card-text"><strong><img src="/assets/img/icons/locations.svg"></strong>{{ housingLocation.city }}</p>
    <p class="card-text">{{ housingLocation.state }}</p>
  </div>
</div>
</div>
`,
  styleUrls: ['./housing-location.component.css']
})
export class HousingLocationComponent {
  @Input() housingLocation!: HousingLocation;
}
