<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//Route::group(['middleware' => ['web']], function () {
//    
//});







Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'Web\Home@index');
    Route::get('/login', 'Web\Home@login');
    Route::post('/login', 'Web\Home@submit_login');
    Route::get('/register', 'Web\Register@index');
    Route::post('/register', 'Web\Register@submit_reg');
    Route::get('/logout', 'Web\Home@logout');
    Route::post('/free-order', 'Web\Home@free_trial');

    Route::get('/vector-order', 'Web\Order@vector');
    Route::get('/digi-order', 'Web\Order@digitizing');
    Route::get('/activate-user/{ActivationCode}', 'Web\Register@activate_user');

    Route::get('/CustomerDash', 'Web\User@CusDashboard');

    Route::get('/CustomerInfo/Update', 'Web\User@update_cus');

    Route::get('/vector_quote', 'Web\Order@vector_quote');
    Route::get('/digi_quote', 'Web\Order@digi_quote');

    Route::post('/sbt_vector_quote', 'Web\Order@plc_vector_quote');
    Route::post('/sbt_digi_quote', 'Web\Order@plc_digi_quote');


    Route::post('/sbt_cus_info/{CustomerID}', 'Web\User@up_cus_info');
    
    Route::get('/updateinfo/{CustomerID}', 'Web\User@bill_check_validate');



    Route::post('/sbt_vector_order', 'Web\Order@plc_vector_order');
    Route::post('/sbt_digi_order', 'Web\Order@plc_digi_order');



    Route::get('/contactus', 'Web\Home@contactus');

    Route::get('/digi_services', 'Web\Home@digi_services');
    Route::get('/vector_services', 'Web\Home@vector_services');


    Route::get('/vector_approvals', 'Web\Order@vector_approvals');
    Route::get('/vector_approval/{OrderID}', 'Web\Order@vector_approval');
    Route::get('/vector_order_approve/{OrderID}', 'Web\Order@vector_approve');

    Route::get('/my_vectors/{status}', 'Web\Order@my_vectors');
    Route::get('/vector_order_done/{OrderID}', 'Web\Order@vector_done');

    Route::post('/vector_revise/{OrderID}', 'Web\Order@vector_revise');


    Route::get('/digi_approvals', 'Web\Order@digi_approvals');
    Route::get('/digi_approval/{OrderID}', 'Web\Order@digi_approval');
    Route::get('/digi_order_approve/{OrderID}', 'Web\Order@digi_approve');

    Route::get('/my_digis/{status}', 'Web\Order@my_digis');
    Route::get('/digi_order_done/{OrderID}', 'Web\Order@digi_done');

    Route::post('/digi_revise/{OrderID}', 'Web\Order@digi_revise');

    // route by Umer
    Route::get('/contactus', 'Web\Home@contactus');
    Route::get('/digitizing_portfolio', 'Web\Home@digiportfolio');
    Route::get('/vector_portfolio', 'Web\Home@vectorportfolio');
    Route::get('/logoartz_portfolio', 'Web\Home@portfolio');
    Route::get('/freedigiorder', 'Web\Home@plc_digi_freeorder');
    Route::get('/about', 'Web\Home@about');
    Route::get('/freevectororder', 'Web\Home@plc_vector_freeorder');
    
    
    Route::get('/vector_quote_record', 'Web\Home@vector_orders_sum');
    Route::get('/vector_order_record', 'Web\Home@vector_orders_sum');
    Route::get('/digi_quote_record', 'Web\Home@digi_quote_sum');
    Route::get('/digi_order_record', 'Web\Home@digi_order_sum');
    
    // end route by Umer

    Route::get('/forgot_password', 'Web\Register@forgot_password');
    Route::post('/forgot_password', 'Web\Register@forgot_password_submit');
    Route::get('/forgotpwd-user/{resetCode}', 'Web\Register@validate_reset');
    Route::post('/forgotpwd-user/{resetCode}', 'Web\Register@submit_validate_reset');


// Rocords 
    Route::get('/dquoterecords', 'Web\Home@getalldigiqoutrecord');
    Route::get('/dorderrecords', 'Web\Home@getalldigiorderrecord');
    Route::get('/vorderrecords', 'Web\Home@getallvectororderrecord');
    Route::get('/vquoterecords', 'Web\Home@getallvectorqoutrecord');

//Customer Accounts
    Route::get('/accounts' ,'Web\Home@accountsdetails');
    Route::get('/digiaccounts' ,'Web\Home@dgetaccdata');
    Route::get('/vectoraccounts' ,'Web\Home@vgetsccdataforcus');

    Route::get('/billings' ,'Web\Home@cus_due_biling_invoices');
    Route::get('/billings001' ,'Web\Home@cus_due_biling');



    Route::get('/genrate/pdfmaininv','Web\Home@invprpdf');
    
// Route::get('/invoice', function(){ 

//     return view('pdfview');

// });


});

//Designers

Route::group(['prefix' => 'designer'], function () {

    Route::get('/', 'Designer\Login@index');
    Route::post('/login', 'Designer\Login@validatelogin');
    Route::get('/logout', 'Designer\Dashboard@logout');
    Route::get('/dashboard', 'Designer\Dashboard@index');
    Route::get('/profile', 'Designer\Profile@index');
    Route::post('/profile', 'Designer\Profile@update');

    Route::get('/vector/{StatusID}', 'Designer\Order@vector_order');
    Route::get('/vector/quote/{StatusID}', 'Designer\Order@vector_quote');
    Route::get('/vector/details/{OrderID}', 'Designer\Order@vector_order_details');
    Route::post('/vector/price/{OrderID}', 'Designer\Order@vector_order_price');
    Route::post('/vector/completed/{OrderID}', 'Designer\Order@vector_complete');
    Route::get('/vector/revision/{type}', 'Designer\Order@vector_revision');

    Route::get('/digi/{StatusID}', 'Designer\Order@digi_order');
    Route::get('/digi/quote/{StatusID}', 'Designer\Order@digi_quote');
    Route::get('/digi/details/{OrderID}', 'Designer\Order@digi_order_details');
    Route::post('/digi/price/{OrderID}', 'Designer\Order@digi_order_price');
    Route::post('/digi/completed/{OrderID}', 'Designer\Order@digi_complete');
    Route::get('/digi/revision/{type}', 'Designer\Order@digi_revision');


    Route::get('/summary', 'Designer\Order@summary');
});




// Route::group(['middleware' => ['Designers']], function () {
//    //  Route::get('/login', 'Web\Home@login');
//    //  Route::get('/register', 'Web\Register@index');
//    //  Route::post('/register', 'Web\Register@submit_reg');
//    //  Route::get('/logout', 'Web\Home@logout');
//    //  Route::get('/vector-order', 'Web\Order@vector');
//    //  Route::get('/digi-order', 'Web\Order@digitizing');
//    //  Route::get('/activate-user/{ActivationCode}', 'Web\Register@activate_user');
//    //  Route::get('/CustomerDash', 'Web\Home@CusDashboard');
//    // Route::get('/CustomerInfo/Update', 'Web\Home@update_cus');
//    // //Route::get('/update_cus_info/{{CustomerID}}', 'Web\Home@up_cus_info'));
//    // Route::get('/sbt_cus_info/{CustomerID}', 'Web\Home@up_cus_info');
// });
// Route::get('/designer', 'Designer\Login@index');
// Route::post('/login', 'Designer\Login@validatelogin');
// Route::get('designer/dashboard', 'Designer\Dashboard@index');
// Route::get('/logout', 'Designer\Dashboard@logout');








Route::group(['prefix' => 'admin'], function() {



    // Login
    Route::get('/', 'Admin\Login@index');
    Route::get('/login', 'Admin\Login@index');
    Route::post('/login', 'Admin\Login@validatelogin');
    Route::get('/logout', 'Admin\Dashboard@logout');

    // Error
    Route::get('/err403', 'Admin\Err403@index');

    // Dashboard
    Route::get('/dashboard', 'Admin\Dashboard@index');

    // Profile
    Route::get('/profile', 'Admin\Profile@index');
    Route::post('/profile', 'Admin\Profile@update');

    // Configuration
    Route::get('/configuration', 'Admin\Configuration@index');
    Route::post('/configuration', 'Admin\Configuration@update');

    // Customers
    Route::get('/customers', 'Admin\Customers@index');
    Route::post('/customers', 'Admin\Customers@customers_list');
    Route::get('/customers/add', 'Admin\Customers@add');
    Route::post('/customers/add', 'Admin\Customers@save');
    Route::get('/customers/{CustomerID}', 'Admin\Customers@edit')->where(['CustomerID' => '[0-9]+']);
    Route::post('/customers/{CustomerID}', 'Admin\Customers@update')->where(['CustomerID' => '[0-9]+']);
    Route::post('/customers/delete', 'Admin\Customers@delete');

    Route::get('/CusStomers/yhydgsysdywikyhkkwsdsdjiasdun/{CustomerID}','Admin\Customers@CustomerAthenR');
    Route::get('/sjdnasjclientaskdn/LdedeeGj8kIsdasN/{CustomerID}','Admin\Customers@w_dujbjm_client');


     // Sales Person
    Route::get('/salesperson', 'Admin\SalesPerson@index');
    Route::post('/salesperson', 'Admin\SalesPerson@salesperson_list');
    Route::get('/salesperson/add', 'Admin\SalesPerson@add');
    Route::post('/salesperson/add/get_vehicles', 'Admin\SalesPerson@getVehicle');
    Route::post('/salesperson/add', 'Admin\SalesPerson@save');
    Route::get('/salesperson/{CustomerID}', 'Admin\SalesPerson@edit')->where(['CustomerID' => '[0-9]+']);
    Route::post('/salesperson/{CustomerID}', 'Admin\SalesPerson@update')->where(['CustomerID' => '[0-9]+']);
    Route::post('/salesperson/delete', 'Admin\SalesPerson@delete');

   
   //Admin All Accounts 

    // Digi Accounts
    Route::get('/digi/accounts', 'Admin\Summary@digi_acc_get');
    Route::post('/search/dacc', 'Admin\Summary@get_all_dacc_req');
    Route::post('/generate-digi-invoice', 'Admin\Summary@generate_digi_inv');
  // Vector Art Accounts
    Route::get('/vector/accounts', 'Admin\Summary@vec_acc_get');
    Route::post('/search/vacc', 'Admin\Summary@get_all_vacc_req');


   //Designer All Accounts 
    Route::get('/designer/acc', 'Admin\Summary@designer_acc');
    Route::post('/search/designerac', 'Admin\Summary@desi_acc_detail');
  // Sales Rep Accounts
    Route::get('/salesrep/acc', 'Admin\Summary@sales_acc');
    Route::post('/search/salesrepac', 'Admin\Summary@sales_acc_detail');
    


    
    //Search
    Route::post('/search/order', 'Admin\Summary@search_order');







//Designers


    Route::get('/designers', 'Admin\Designers@index');
    Route::post('/designers', 'Admin\Designers@designers_list');

    Route::get('/designers/add', 'Admin\Designers@add');
    Route::post('/designers/add', 'Admin\Designers@save');

    Route::get('/designers/{DesignerID}', 'Admin\Designers@edit')->where(['DesignerID' => '[0-9]+']);
    Route::post('/designers/{DesignerID}', 'Admin\Designers@update')->where(['DesignerID' => '[0-9]+']);

    Route::post('/designers/delete', 'Admin\Designers@delete');

    Route::get('/designers/details/{DesignerID}', 'Admin\Designers@details');






    // Summary
    Route::get('/summary', 'Admin\Summary@index');
    Route::post('/summary', 'Admin\Summary@update');
    Route::post('/search/summary', 'Admin\Summary@search_records');            




    Route::get('/vector/orders/{StatusID}', 'Admin\Summary@vector_orders');
    Route::get('/Vec_order-details/{VectorOrderID}', 'Admin\Summary@vec_OrderDetail');
    Route::get('/vector/newquotes/{QuotePrice}', 'Admin\Summary@new_vector_quote');

    Route::post('/vec-assign-designer/{VectorOrderID}', 'Admin\Summary@VecAssignSubmit');
    Route::post('/vec-send-quote/{VectorOrderID}', 'Admin\Summary@VecSendQuote');

    Route::post('/vec-approve-designer/{id}', 'Admin\Summary@approve_vector_design');
    Route::post('/vec-send-order/{id}', 'Admin\Summary@send_vector_design');

    Route::post('/order_revision/{id}', 'Admin\Summary@order_revision');
    Route::post('/quote_revision/{id}', 'Admin\Summary@quote_revision');



    Route::get('/digi/orders/{StatusID}', 'Admin\Summary@digi_orders');
    Route::get('/Norder-details/{OrderID}', 'Admin\Summary@OrderDetail');
    Route::get('/digi/newquotes/{QuotePrice}', 'Admin\Summary@new_digi_quote');

    Route::post('/digi-assign-designer/{OrderID}', 'Admin\Summary@AssignSubmit');
    Route::post('/digi-send-quote/{OrderID}', 'Admin\Summary@SendQuote');

    Route::post('/digi-approve-designer/{id}', 'Admin\Summary@approve_digi_design');
    Route::post('/digi-send-order/{id}', 'Admin\Summary@send_digi_design');

    Route::post('/digi_order_revision/{id}', 'Admin\Summary@digi_order_revision');
    Route::post('/digi_quote_revision/{id}', 'Admin\Summary@digi_quote_revision');

// Route::get('Digi/RevOrderSum', 'Admin\Summary@RevOrders');
// Route::get('Digi/NewQuoteSum', 'Admin\Summary@NewQuotes');
// Route::get('Digi/QuteRevSum', 'Admin\Summary@QuteRev');
// Route::get('Digi/ExtraTimeSum', 'Admin\Summary@ExtraTime');
// Route::get('Digi//Norder-details', 'Admin\Summary@ExtraTime');


    // Status Change Module
    Route::post('/digi-status-change/{OrderID}', 'Admin\Summary@status_update');



});

Route::group(['prefix' => 'salesperson'], function() {

    //Login
    Route::get('/', 'SalesPerson\Login@index');
    Route::get('/login', 'SalesPerson\Login@index');
    Route::post('/login', 'SalesPerson\Login@validatelogin');
    Route::get('/dashboard', 'SalesPerson\Dashboard@index');
    Route::get('/customers', 'SalesPerson\Customers@Customers_all');


    // Customers
    Route::get('/customers', 'SalesPerson\Customers@index');
    Route::post('/customers', 'SalesPerson\Customers@customers_list');

    Route::get('/salesperson/view/{CustomerID}', 'SalesPerson\Customers@customer_view')->where(['CustomerID' => '[0-9]+']);


    Route::get('/dorder_details/{OrderID}', 'SalesPerson\Customers@digi_order_detail');
    Route::get('/dquote_details/{OrderID}', 'SalesPerson\Customers@digi_quote_detail');

    Route::get('/vectororder-details/{OrderID}', 'SalesPerson\Customers@vector_order_detail');
    Route::get('/vectorqoute_details/{OrderID}', 'SalesPerson\Customers@vector_quote_detail');
    

    // A D D     N O T E ///
    Route::post('/addcustomer_note/{CustomerID}', 'SalesPerson\Customers@add_cus_note');



    Route::get('/digi/orders/{StatusID}', 'SalesPerson\Orders@digi_orders');
    Route::get('/vector/orders/{StatusID}', 'SalesPerson\Orders@vector_orders');

    Route::get('/Vec_order-details/{VectorOrderID}', 'Admin\Summary@vec_OrderDetail');

    Route::get('/digi_order_detail/{OrderID}', 'SalesPerson\Orders@digi_order_detail');
    Route::get('/vector_order_detail/{VectorOrderID}', 'SalesPerson\Orders@vec_order_detail');

    Route::get('/digi/orders/{StatusID}', 'SalesPerson\Orders@digi_orders');

    
    Route::get('/summary', 'SalesPerson\Orders@summary_view');
    Route::post('/summary', 'SalesPerson\Orders@getalldata');

   Route::get('/logout', 'SalesPerson\CofigCon@logout_sales_user');
});
