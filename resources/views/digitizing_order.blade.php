<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
<!--<![endif]-->


<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Digitizing Order</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.carousel.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.theme.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.transitions.css" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/spsimpleportfolio.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/featherlight.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/style.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/responsive.css" media="screen"> 


 <style type="text/css">
label{
    font-size: 14px !important;
}
</style>

    </head>

 <style type="text/css">
        /* red */
.icheckbox_minimal-red,
.iradio_minimal-red {
    display: inline-block;
    *display: inline;
    vertical-align: middle;
    margin: 0;
    padding: 0;
    width: 18px;
    height: 18px;
    background: url(red.png) no-repeat;
    border: none;
    cursor: pointer;
}

.icheckbox_minimal-red {
    background-position: 0 0;
}
    .icheckbox_minimal-red.hover {
        background-position: -20px 0;
    }
    .icheckbox_minimal-red.checked {
        background-position: -40px 0;
    }
    .icheckbox_minimal-red.disabled {
        background-position: -60px 0;
        cursor: default;
    }
    .icheckbox_minimal-red.checked.disabled {
        background-position: -80px 0;
    }

.iradio_minimal-red {
    background-position: -100px 0;
}
    .iradio_minimal-red.hover {
        background-position: -120px 0;
    }
    .iradio_minimal-red.checked {
        background-position: -140px 0;
    }
    .iradio_minimal-red.disabled {
        background-position: -160px 0;
        cursor: default;
    }
    .iradio_minimal-red.checked.disabled {
        background-position: -180px 0;
    }



 </style>   
    

<body class="inner body-innerwrapper">
   
    <!--Header-->
    

      @include('includes/header')





    <!--Bread Crumb-->
    <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>DIGITIZING ORDER</h3>
                    <ol class="breadcrumb">
                          <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                        <li>
                            <a href="{{ url('/CustomerDash')}}">Home</a>
                        </li>
                    <?php }else{ ?>

                           <li>
                            <a href="{{ url('/')}}">Home</a>
                        </li>
                    <?php } ?>
                        <li class="active">Digitizing Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Services-->
  


                                 {{ Form::open(['method'=>'post', 'url'=>'/sbt_digi_order', 'files'=>'true']) }}


    <div class="container" style="padding:2em;">
            <section>	
                 <h3 style="color:#555555;text-align: center;margin-top: 7px;">PLACE DIGITIZING ORDER</h3>
                 <form role="form">

                         <div class="box-body">	
                                @include('includes/front_alerts')

                                 <div class="row">
                                         <div class="col-md-3"> 
             
                                             <div class="form-group">
                                                 <label for="Design">Design Name:</label>
                                             
                                                 {{ Form::text('DesignName', null, ['placeholder' => 'Design Name', 'class' => 'form-control']) }}
    
                                              </div>
                                             
                                     </div>


                                            <div class="col-md-3"> 

                                                  <div class="form-group">
                                                 <label for="PONumber">PO Number</label>
                                          
                                                 {{ Form::text('PoNum', null, ['placeholder' => 'Enter PO Number', 'class' => 'form-control']) }}
                                               </div>


                                            </div>


                                            <div class="col-md-3"> 
                                                  <div class="form-group">
                                                     <label>Requried Format</label>
                                                     {{ Form::select('ReqFormat', array('' => 'Select',
                                                                                        'PDF' => 'PDF',
                                                                                        'JPEG' => 'JPEG',
                                                                                        'PNG' => 'PNG',
                                                                                         'EMB' => 'EMB',
                                                                                        'DST' => 'DST',
                                                                                        'POF' => 'POF',
                                                                                        'PXF' => 'PXF',
                                                                                         'EXP' => 'EXP',
                                                                                        'CND' => 'CND',
                                                                                        'Other' => 'Other'),
                                                     null, array('class' => 'form-control')) }}
                                                 </div>
                                            </div>


                                            <div class="col-md-3"> 
                                                 <div class="form-group">
                                                     <label>Fabric</label>
                                                     
                                                       
                                                         {{ Form::select('Fabric', array('' => 'Select',
                                                                                    'Pique Polo' => 'Pique Polo',
                                                                                    'Cotton' => 'Cotton',
                                                                                    'Performance Polyester' => 'Performance Polyester',
                                                                                    'Silk' => 'Silk',
                                                                                    'Twill' => 'Twill',
                                                                                    'Towel' => 'Towel',
                                                                                    'Woolen' => 'Woolen',
                                                                                    'Linen' => 'Linen',
                                                                                    'Leather' => 'Leather',
                                                                                    'Felt' => 'Felt',
                                                                                    'Tote' => 'Tote',
                                                                                    'Mesh' => 'Mesh',
                                                                                    'Beanies' => 'Beanies',
                                                                                    'Fleece/Softshell' => 'Fleece/Softshell/',
                                                                                    'Other' => 'Other'),
                                                     null, array('class' => 'form-control')) }}
                                                     
                                                 </div>
                                            </div>


                                 </div>



                     

                           <div class="row">
                       

                         <div class="col-md-3"> 
                                <div class="form-group">
                                 <label for="OtherFormat">Other Format:</label>

                                  {{ Form::text('OtherFormat', null, ['placeholder' => 'Other Format', 'class' => 'form-control']) }}
                               
                               </div>

                       </div>



                             <div class="col-md-3"> 

                                 <div class="form-group">
                                         <label>Placement</label>
                                           {{ Form::select('Placement', array(
                                                                            '' => 'Select',
                                                                        'Cap Front' => 'Cap Front',
                                                                        'Cap Side' => 'Cap Side',
                                                                        'Cap Back' => 'Cap Back',
                                                                        'Left Chest' => 'Left Chest',
                                                                        'Jacket Back' => 'Jacket Back',
                                                                        'Gloves' => 'Gloves',
                                                                        'Towel' => 'Towel',
                                                                        'Visor' => 'Visor',
                                                                        'Sleeve' => 'Sleeve', 
                                                                        'Socks' => 'Socks',  
                                                                        'Collar' => 'Collar',
                                                                        'Other' => 'Other'
                                                                        ),
                                        null, array('class' => 'form-control')) }}
                                     </div>

                         </div>



                          <div class="col-md-2"> 
                                <div class="form-group">
                                 <label for="Width">Height</label>

                                  {{ Form::text('Height', null, ['placeholder' => 'Height', 'class' => 'form-control']) }}
                         
                                </div>

                         </div>
                         
                         
                         
                            <div class="col-md-2"> 
                                <div class="form-group">
                                 <label for="Width">Width</label>

                                  {{ Form::text('Width', null, ['placeholder' => 'Width', 'class' => 'form-control']) }}
                         
                                </div>

                         </div>

                        <div class="col-md-2"> 

                               <div class="form-group">
                                     <label>Scale</label>
                                     {{ Form::select('Scale', array('' => 'Select',
                                                                    'Inch' => 'Inch',
                                                                    'Centimeter' => 'Centimeter',
                                                                    'Millimeter' => 'Millimeter',
                                                                    'Pixel' => 'Pixel'),
                                    'Inch', array('class' => 'form-control')) }}
                                 </div>


                         </div>

             

                        </div> <!--ROW CLOSE-->




                         <div class="row">
                                 <div class="col-md-3"> 
                                                <div class="form-group">
                                                     <label for="NumofClr">Number of Colors</label>

                                                 {{ Form::text('NumofClr', null, ['placeholder' => 'Number of Colors', 'class' => 'form-control']) }}
                                                   
                                                 </div>

                            

                                 </div>  <!--Col Close-->


                                 <div class="col-md-3"> 
                                       <div class="form-group">
                                                     <label for="FabricClr">Fabric Color</label>

                                                 {{ Form::text('FabricClr', null, ['placeholder' => 'Please Specify', 'class' => 'form-control']) }}
                                                 </div>

                                 </div> <!--Col Close-->


                                <div class="col-md-3"> 
                        
                                                  <div class="form-group">
                                                                <label for="FabricClr">Color Blending?</label>
                                                                {{ Form::select('Clrblending', array(
                                                                                                'Yes' => 'Yes',
                                                                                                'No' => 'No',
                                                                                                'Not Sure' => 'Not Sure'),
                                                                  'Not Sure', array('class' => 'form-control')) }}
                                                            </div>

                                 </div> <!--Col Close-->

                                  <div class="col-md-3"> 
                            
                                   <div class="form-group">
                                                        <label for="PictureEmbroidery">Picture Embroidery?</label>
                                                        {{ Form::select('PicEmb', array(
                                                                                        'Yes' => 'Yes',
                                                                                        'No' => 'No',
                                                                                        'Not Sure' => 'Not Sure'),
                                                            'Not Sure', array('class' => 'form-control')) }}
                                                    </div>

                                 </div> <!--Col Close-->




                          </div>  <!--Row Close-->


                                     
                         <div class="row">
                           
                         
                              <div class="col-md-3"> 
                           
                              <div class="form-group">
                                    <label for="FabricClr">Background Fill?</label>
                                    {{ Form::select('BackFill', array(
                                                                'Yes' => 'Yes',
                                                                'No' => 'No',
                                                                'Not Sure' => 'Not Sure'),
                                    'Not Sure', array('class' => 'form-control')) }}
                                </div>
                           </div>
                              

                            <div class="col-md-9"> 
                      
                                       <div class="col-md-12">
                                                     <div class="form-group">
                                                             <label for="instraction">Additional Instructions:</label>

                                     {{ Form::textarea('AddIns', null, ['placeholder' => 'Additional Instructions', 'class' => 'form-control', 'row' => '5']) }}
                                                         </div>
                                             </div>
                     
                             </div>     





                            </div>

                  

                 </div>

      

                                 <div class="row">
                                          
                                             
                                 </div><!--ROW Close-->




                                 <div class="row">
                                         <div class="col-md-6">
                                         <label for="Filesattach" rows="2"><b> Files </b>  (MAXIMUM SIZE: 10MB):</label>
                                             <label style="color: blue">Upload Minimum one file</label>
                                     </div>
                                 </div> <br> 
                                 



                                 <div class="row">
                                         <div class="col-md-6">
                                                 <div class="form-group">
                                                         <label for="exampleInputFile">Attahment 1</label>
                                                         {{ Form::file('FileOne') }}
                                             </div>
                                         </div> <!--Col Close-->

                                         
                                         <div class="col-md-6">
                                                 <div class="form-group">
                                                         <label for="exampleInputFile">Attahment 2</label>
                                                         {{ Form::file('FileTwo') }}
                                                  </div>

                                         </div><!--Col Close-->
                                 </div> <!--Row Close-->

                                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attahment 3</label>
                                    {{ Form::file('FileThree') }}
                                </div>
                            </div> <!--Col Close-->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attahment 4</label>
                                    {{ Form::file('FileFour') }}
                                </div>

                            </div><!--Col Close-->
                        </div> <!--Row Close-->






                              
                                 <div class="row">

                                    <div class="col-md-6">
                                                 
                                                 <div class="form-group">

                                             <label for="Filesattach" rows="2"><b>Order Type: </b></label>
                                                  {{ Form::select('OrderType', array(
                                                                '1' => 'Normal',
                                                                '2' => 'Urgent'
                                                                ),
                                    'NotSure', array('class' => 'form-control')) }}
                                             </div>
                                             
                                          </div>

                                         <div class="col-md-6">
                                                 
                                                 <div class="form-group">

                                             <label for="Filesattach" rows="2"><b> CC This order to </b></label>
                                                 <input type="email" name="CCOrder" value="" placeholder="CC This order to" class="form-control">
                                             </div>
                                             
                                          </div>

                                           
                                </div>

                                
                         <div class="box-footer pull-right">
                     
                           <button type="submit" class="btn orange-btn">SUBMIT</button>
                         </div>

                            

                            
                               </div>     



                 
           
                       </form>


                                         {{ Form::close()}}
<!-- 
                         
                     
 
                         <form enctype="multipart/form-data" action="" id="">
                                 
 
 
                             
                     <div class="col-md-4 col-sm-5 wow fadeInLeft"> 
                             <div class="column col-md-6">
                                     <span class="wpcf7-form-control-wrap text-field-required">
                                     <div class="form-group">
                                             <label for="sel1">Requried Format:</label>
                                             <select class="form-control" id="sel1">
                                               <option>PDF</option>
                                               <option>JPG</option>
                                               <option>SVG</option>
                                               <option>AI</option>
                                             </select>
                                           </div>
                                        </span>
                                 </div>	
                     </div>
                                     
                                 
             
 
 
 
                             </form> -->
 
 
                         </section>	
                         </div>
 







                















                     </div>

    <!--footer-->
   
  @include('includes/footer')

        <!--Copyright-->
    
        <!--All Js-->
         <script type="text/javascript" src="{{ asset('assets/web') }}/js/jQuery.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/bootstrap.js"></script>
        <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/appear.js"></script>
        <!--Portfolio-->
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/isotope.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/spsimpleportfolio.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/featherlight.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.shuffle.modernizr.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/steller.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/smooth-scroll.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/owl.carousel.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/custom.js"></script>
    </body>
    
    </body>
    
    
    <!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
    </html>
    