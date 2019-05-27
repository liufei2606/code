import "reflect-metadata";
import {createConnection} from "typeorm";
import {Catalog} from "./entity/Catalog";

createConnection().then(async connection => {

    console.log("Inserting a new user into the database...");
	let catalog = new Catalog();
	catalog.journal = "Oracle Magazine";
	catalog.publisher = "Oracle Publishing";
	catalog.edition = "March-April 2005";
	catalog.title = "Starting with Oracle ADF";
	catalog.author = "Steve Muench";
	catalog.isPublished = true;;
	await connection.manager.save(catalog);

	console.log("Saved a new user with id: " + catalog.id);

	let catalog2 = new Catalog();
	catalog2.journal = "Oracle Magazine";
	catalog2.publisher = "Oracle Publishing";
	catalog2.edition = "November December 2013";
	catalog2.title = "Engineering as a Service";
	catalog2.author = "David A. Kelly";
	catalog2.isPublished = true;

	await connection.manager.save(catalog2);
	console.log("Saved a new user with id: " + catalog2.id);
    console.log("Loading users from the database...");
    const Catalogs = await connection.manager.find(Catalog);
    console.log("Loaded users: ", Catalogs);

    console.log("Here you can setup and run express/koa/any other framework.");

}).catch(error => console.log(error));
