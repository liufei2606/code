"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
exports.AppModule = void 0;
var core_1 = require("@angular/core");
var platform_browser_1 = require("@angular/platform-browser");
var forms_1 = require("@angular/forms");
var http_1 = require("@angular/common/http");
var angular_in_memory_web_api_1 = require("angular-in-memory-web-api");
var in_memory_data_service_1 = require("./in-memory-data.service");
var app_routing_module_1 = require("./app-routing.module");
var app_component_1 = require("./app/app.component");
var dashboard_component_1 = require("./dashboard/dashboard.component");
var hero_detail_component_1 = require("./hero-detail/hero-detail.component");
var heroes_component_1 = require("./heroes/heroes.component");
var hero_search_component_1 = require("./hero-search/hero-search.component");
var messages_component_1 = require("./messages/messages.component");
var AppModule = /** @class */ (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        core_1.NgModule({
            imports: [
                platform_browser_1.BrowserModule,
                forms_1.FormsModule,
                app_routing_module_1.AppRoutingModule,
                http_1.HttpClientModule,
                // The HttpClientInMemoryWebApiModule module intercepts HTTP requests
                // and returns simulated server responses.
                // Remove it when a real server is ready to receive requests.
                angular_in_memory_web_api_1.HttpClientInMemoryWebApiModule.forRoot(in_memory_data_service_1.InMemoryDataService, { dataEncapsulation: false })
            ],
            declarations: [
                app_component_1.AppComponent,
                dashboard_component_1.DashboardComponent,
                heroes_component_1.HeroesComponent,
                hero_detail_component_1.HeroDetailComponent,
                messages_component_1.MessagesComponent,
                hero_search_component_1.HeroSearchComponent
            ],
            bootstrap: [app_component_1.AppComponent]
        })
    ], AppModule);
    return AppModule;
}());
exports.AppModule = AppModule;
