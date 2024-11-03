import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HomeComponent } from './home/home.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [HomeComponent],
  template: `
   <main>
    <div class="container">
      <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="/assets/img/icons/home.svg" alt="" width="30" height="24">
        </a>
      </div>
    </nav>
      <section class="container">
        <app-home></app-home>
      </section>
      </div>
    </main>`,
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'my-app-angular';
}
