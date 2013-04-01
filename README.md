SOLRSearch
==========

SOLR Search for Elgg Version 0.1.0

First Release of SOLR integration into Elgg

Far from being production ready and not suited for beginners.

Pre-requisites:
==============

SOLR 4.2.0
SOLARIUM 3.1.0

Setting up SOLR:

Copy the folder solr/example/solr/collection1 to solr/example/solr/collectionElgg
Copy solr.xml to solr/example/solr (rename the existing one in order to preserve it)
Copy schema.xml to solr/example/solr/collectionElgg/conf
Copy db-data-config.xml to solr/example/solr/collectionElgg/conf
Copy solrconfig.xml to solr/example/solr/collectionElgg/conf

All xml configs are in the repo under SOLRSearch/Vendor/SOLR_Config_Elgg

After this start SOLR in solr/example/solr with java -jar start.jar

Now you should be up and running and able to access your SOLR with http://localhost:8983/solr/

Now comes the hard part - importing your data into SOLR

Select the collectionElgg Core and click on "dataimport" (last entry on the left side)

Select the command "full-import" and the entity "ElggEntity"

Hold your fingers crossed!

If everything worked well you should now be able to query SOLR Core. To do this select "Query" on the left side.


Setting up Solarium:
====================

Nothing to do here as it is inside of the Repo for convenience. Better would be to install it using composer.
Solarium is a very nice PHP client to SOLR.


Remarks:
========

This is still very early code and needs much more to become ready!

All Elgg entities are flattened / denormalized to the SOLR Index using the data importer.

Currently this is not optimized at all in several dimensions:

1. There is no delta-import yet included.
2. The SQL is not optimized.
3. The field definitions are not optimized. All fields are flagged as "stored" and "indexed" to ease further development.

The idea is to have 2 Index in the end:

One for all entities and one for user / profile searches. The second is not started as of yet.

What's implemented:
===================

The searchbox in the titlebar is directed towards SOLR.
A form on the sidebar of the resulting page let's you perform queries with selection of Subtypes and Fields to search on.


To Do's - Next:
===============

Implement dynamic Profile Search 
---------------------------------------------

-> Sophisticated profile search with all features you can dream of.
Design is still to be done.


Generation of SOLR Schema / db config from Admin Menu
-----------------------------------------------------------------------------
-> the approach is to deduce the metadata produced by the Profile Manager to generate the schema and the data importer.

-> same for entities
Design is still to be done.

Query enhancements
----------------------------

All those fance features of SOLR/Lucene such as highliting, facets, etc.

Get the Views right
-------------------------

Last but not least ease of use and exploitation of the SOLR capabilities for end users.












