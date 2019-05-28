import "reflect-metadata";
import {createConnection} from "typeorm";
import {Catalog} from "./entity/Catalog";
import {CatalogTimestamp} from "./entity/CatalogTimestamp";
import { serialize } from "class-transformer";

createConnection().then(async connection => {

    console.log("Inserting a new user into the database...");
	let catalog = new Catalog();
	catalog.journal = "Oracle Magazine";
	catalog.publisher = "Oracle Publishing";
	catalog.edition = "March-April 2005";
	catalog.title = "Starting with Oracle ADF";
	catalog.author = "Steve Muench";
	catalog.isPublished = true;

	let timestamp = new CatalogTimestamp();
	timestamp.firstAdded = "Apr-8-2014-7:06:16-PM-PDT";
	timestamp.firstUpdated = "Apr-8-2014-7:06:20-PM-PDT";
	timestamp.lastUpdated = "Apr-8-2014-7:06:20-PM-PDT";
	timestamp.catalog = catalog; 
	let catalogRepository = connection.getRepository(Catalog);

	await catalogRepository.save(catalog);
	console.log("Catalog has been saved");
	let catalogs = await catalogRepository.find({ relations: ["timestamp"] });
	console.log(JSON.stringify(catalogs));

	// let catalogNews = await connection
	// 	.getRepository(Catalog)
	// 	.createQueryBuilder("catalog")
	// 	.innerJoinAndSelect("catalog.timestamp", "timestamp")
	// 	.getMany();
	// console.log(JSON.stringify(catalogNews));

	// await catalogRepository.save(catalog);
	// console.log("Saved a new user with id: " + catalog.id);

	let catalog2 = new Catalog();
	catalog2.journal = "Oracle Magazine";
	catalog2.publisher = "Oracle Publishing";
	catalog2.edition = "November December 2013";
	catalog2.title = "Engineering as a Service";
	catalog2.author = "David A. Kelly";
	catalog2.isPublished = true;

	// await catalogRepository.save(catalog2);
	// console.log("Saved a new user with id: " + catalog2.id);

	// select
    // console.log("Loading users from the database...");
	// let [all_catalog, CatalogsCount] = await catalogRepository.findAndCount();
	// console.log("Loaded users: ", CatalogsCount);
	// let allCatalogs = await catalogRepository.find({ select: ["title", "author"] });
	// console.log("All Catalogs from the db: ", JSON.stringify(allCatalogs) + '\n');
	// let firstCatalog = await catalogRepository.findOne(1);
	// console.log('First Catalog from the db: ', JSON.stringify(firstCatalog) + '\n');
	// let specificTitleCatalog = await catalogRepository.findOne({ title: "Engineering as a Service" });
	// console.log("'Engineering as a Service' Catalog from the db: ", JSON.stringify(specificTitleCatalog) + '\n');
	// let allSpecificEditionCatalogs = await catalogRepository.find({ edition: "November December 2013" });
	// console.log('All November December 2013 Catalogs: ', JSON.stringify(allSpecificEditionCatalogs) + '\n');
	// let allPublishedCatalogs = await catalogRepository.find({ isPublished: true });
	// console.log('All published Catalogs: ', JSON.stringify(allPublishedCatalogs) + '\n');

	// update
	// let catalogToUpdate = await catalogRepository.findOne(1);
	// console.log('Updated Catalog from the db: ', JSON.stringify(catalogToUpdate) + '\n');
	// catalogToUpdate.title = "Beginning with Oracle PDF";
	// await catalogRepository.save(catalogToUpdate);
	// let updatedCatalog = await catalogRepository.findOne(1);
	// console.log('Updated Catalog from the db: ', JSON.stringify(updatedCatalog) + '\n');

	// delete
	// let catalogToRemove = await catalogRepository.findOne(1);
	// await catalogRepository.remove(catalogToRemove);
	// let reFirstCatalog = await catalogRepository.findOne(1);
	// console.log("First Catalog from the db: ", JSON.stringify(reFirstCatalog));

}).catch(error => console.log(error));
