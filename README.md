For this assignment you will populate your database from homework3 with data.  Step 1 is to ensure your tables are correct.  You will need to have the correct tables for this homework to work, if table structure has some issue, you will correct them before moving forward.

In HW3 you created the schema (set of tables) for the database.  These are simply empty tables.  In this homework assignment you will create some mock data for your tables.  You will need to use techniques from HW3 to complete this assignment.  You must use PHP to generate your data and your data.sql file.  You will need to provide a script that updates all the tables with data that you have generated.  It would take hours (days?) for you to attempt to do this manually.

You should think of generating the data as a mad libs type of scheme.  https://en.wikipedia.org/wiki/Mad_Libs#FormatLinks to an external site..  You should could choose something like this for product description:

A __________  ____________ in an _________ ________ made of ____________ useful for _________.

    adjective         noun                            adjective     color                           noun (material)                       verb

An example for this would be

A wonderful hammer in a illustrious blue made of plastic useful for digging. 

For product descriptions you can simply use a format such as

“A wonder $productName for you to enjoy”.   But the concept still applies … take a random first name and a random last name to create a random full name.  You will randomly assign a street number, name, type, city, and state to create an address.

Include any source code that you used to generate your data as well with your submission.  Also include your schema.sql file with your submission.

I should be able to run your schema.sql file, then your data.sql file and have a complete database populated with data.  Test this before you submit!  Rename your original database so you can save it, then use your scripts to create a new database to test your scripts.

###Part 1 – Create your data for your tables.
The following is a list of tables you should have created in HW4.  The Primary Keys are underlined bold, foreign keys are italics.

customer(customer_id, first_name, last_name, email, phone, address_id)
order(order_id, customer_id, address_id)
product(product_id, product_name, description, weight, base_cost)
order_item (order_id, product_id, quantity, price)
address(address_id, street, city, state, zip)
warehouse(warehouse_id, name, address_id)
product_warehouse(product_id, warehouse_id)
For each table, here is how many records you need to generate.

customer – 100
order – 350
product – 750
order_item – 550
address – 150
warehouse – 25
product_warehouse – 1250
The order that you insert into these tables is important.  I will generate an ordering soon as well as an explanation.  The short answer is this, you can’t add a customer with an address_id until there is already an address with a matching address_id.

ORDER TO INSERT DATA:

address
customer
order
product
warehouse
order_item
product_warhouse
You can deviate from this order somewhat if you understand the implications.

###Part 2 – Create a PDF Report
Create and submit a PDF report that briefly describes how you generated your data.  This should include anything you feel that you did that was clever, as well as how you overcame any obstacles in this project.  Would you do things differently if you had to do this assignment again?  What format did you decide to use for input text files (if you used them)?  How did you input your values to generate random data?  Create a YouTube video to present your homework’s completeness and correctness.

###Part 3 – Deliverables for this assignment:
schema.sql
data.sql
any php files used to generate random data
any input files used to generate data
1 page PDF report
1 short youtube video to present your homework’s completeness and correctness.
