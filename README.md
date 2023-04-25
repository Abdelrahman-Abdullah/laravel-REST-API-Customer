# Laravel REST API using `Sanctum`

## Notes : 
```
 - Any User Can only Check All Customers and Invoices.
 - Authenticated users only can create , update and delete.
 - Take care about what token can do.
```

## Routes :
- Every Route Start With Prefix `v1`

```
# PUBLIC
==========
GET  /api/v1/customers
GET  /api/v1/customers/:id
@fitler: [?name , ?city, ?type, ?includeInvoices = true] 
---------------------------------------------------------
GET  /api/v1/invoices
GET  /api/v1/invoices/:id
@fitler: [?customerId , ?status] 
---------------------------------------------------------
POST  /api/v1/users/register
@body: [name, email, password, password_confirmation]

POST  /api/v1/users/login
@body: [email, password]


#PROTECTED
===========
POST  /api/v1/customers
@body: [name , email, address, city, state, type, postalCode]
type in (['I' , 'B']) 

PUT  /api/v1/customers/:id
@body: [name , email, address, city, state, type, postalCode]
type in (['I' , 'B']) 
---------------------------------------------------------
POST  /api/v1/invoices
@body: [customerId , amount, status, billedDate, paidDate => optional]
status in (['P' ,'B', 'V']) 

PUT  /api/v1/invoices/:id
@body: [customerId , amount, status, billedDate, paidDate => optional]
status in (['P' ,'B', 'V'])
---------------------------------------------------------

# Add Bulk of invoices during one time
POST  /api/v1/invoices/bulk
@body: [customerId , amount, status, billedDate, paidDate => optional]
status in (['P' ,'B', 'V'])

---------------------------------------------------------
POST  /api/v1/users/logout

```
