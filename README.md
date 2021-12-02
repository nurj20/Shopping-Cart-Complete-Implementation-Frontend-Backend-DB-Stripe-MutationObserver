# Complete Shopping Cart Impleentation With Online Payment
Implements complete logic for shopping cart.
Items to buy are dynamically displayed using FETCH API request to backend, which sends all the items and their details.
Shopping cart is updated in real time as the customer keeps adding/ removing items in the cart.
Checkout logic calculates the prices, connects with Stripe with the amount to be dedected from the customer's credit cart.
Stripe ends session id which is sent to frontend which in turn directs the cutomers to Stripe checkout page along with the session id.
Customer is charged based on the amount associated with that session id.
## Frontend
HTML, CSS, JS, FETCH
## Backend
PHP, STRIPE
## Database
Mysql which stores all the items to be boughtw

## P.S 
You must provide your own Stripe public and secrect keys for the frontend and backend respectively in order for the logic to work