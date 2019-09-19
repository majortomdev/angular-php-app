import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  policies: Policy[];
  selectedPolicy: Policy = { id: null , number: null, amount: null };

  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.readPolicies().subscribe((policies: Policy[])=>{
      this.policies = policies;
      console.log(this.policies);
    })

  }

}
