import { Component, OnInit } from '@angular/core';
import { MetaService } from '../meta.service';
@Component({
  selector: 'app-hello',
  templateUrl: './hello.component.html',
  styleUrls: ['./hello.component.css'],
  providers: [MetaService]
})
export class HelloComponent implements OnInit {
  meta = [];
  constructor(private metaService: MetaService) { }
  ngOnInit() {
    this.meta = this.metaService.getNames();
  }
}