import "reflect-metadata";
import { createConnection } from "typeorm";
import { CatalogEdition } from "./entity/CatalogEdition";
import { CatalogEntry } from "./entity/CatalogEntry";
import { serialize } from "class-transformer";

createConnection({
	type: "mysql",
	host: "localhost",
	port: 3306,
	username: "root",
	password: "root",
	database: "test",
	entities: [
		__dirname + "/entity/*.ts"
	],
	synchronize: true,
	logging: false
}).then(async connection => {
	// Create entity instances and save data to entities
}).catch(error => console.log(error));
