<!DOCTYPE html>

<html lang="en" class="demo-2 no-js">


    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Vectar Order</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon" />


        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/bootstrap.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-awesome.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/icofont.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/hover-min.css') }}" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.carousel.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.theme.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.transitions.css') }}" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/spsimpleportfolio.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/featherlight.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/style.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/responsive.css') }}" media="screen"> 


 <style type="text/css">
label{
    font-size: 14px !important;
}
</style>


    </head>


    <body class="inner body-innerwrapper">

        <!--Header-->



        @include('includes/header')




        <!--Bread Crumb-->
        <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">

                        <h3>Vector Art</h3>
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
                            <?php
                            if (\Session::has('CustomerLogin')) {
                                ?>

                                <li class="active">Vector Order</li>

                            <?php } ?>


                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--Services-->


        <div class="container" style="padding:2em;">
            <section>	
                <h3 style="color:#555555;text-align: center;margin-top: 7px;">PLACE VECTOR ORDER</h3>


                {{ Form::open(['method'=>'post', 'url'=>'/sbt_vector_order', 'files'=>'true']) }}

                <form action="{{ url('/sbt_vector_order') }}"  novalidate method="POST" enctype="multipart/form-data">

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
                                                                                    'Corel Draw (CDR)' => 'Corel Draw (CDR)',
                                                                                    'Adobe Illustrator (AI)' => 'Adobe Illustrator (AI)',
                                                                                    'Encapsulated Post Script File (EPS)' => 'Encapsulated Post Script File (EPS)',
                                                                                    'Adobe Acrobat (PDF)' => 'Adobe Acrobat (PDF)',
                                                                                    'Macromedia Freehand (MF)' => 'Macromedia Freehand (MF)',
                                                                                    'Photoshop (PSD)' => 'Photoshop (PSD)',
                                                                                    'Other' => 'Other'),
                                                 null, array('class' => 'form-control')) }}
                                </div>
                            </div>



                            <div class="col-md-3"> 

                                <div class="form-group">
                                    <label for="OtherFormat">Other Format:</label>


                                    {{ Form::text('OtherFormat', null, ['placeholder' => 'Other Format', 'class' => 'form-control']) }}
                                </div>

                            </div>



                        </div>





                        <div class="row">
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label>Vector will be used for</label>
                                    {{ Form::select('UsedFor', array('' => 'Select',
                                                                            'Screen Printing' => 'Screen Printing',
                                                                            'DTG (Direct to Garment)' => 'DTG (Direct to Garment)',
                                                                            'Vinyl' => 'Vinyl',
                                                                            'Heat Transfer' => 'Heat Transfer',
                                                                            'Block Printing' => 'Block Printing',
                                                                            'Digital Printing' => 'Digital Printing',
                                                                            'Offset Printing' => 'Offset Printing',
                                                                            'Other' => 'Other'),
                                         null, array('class' => 'form-control')) }}
                                </div>
                            </div>


                           

                            <div class="col-md-2"> 
                                <div class="form-group">
                                 <label for="Width">Height</label>
                                  {{ Form::text('Height', null, ['placeholder' => 'Height', 'id' => 'height', 'class' => 'form-control']) }}
                                </div>
                         </div>
                         <div class="col-md-2"> 
                            <div class="form-group">
                             <label for="proportion">Is Proportion?</label>
                             <input type="checkbox" name="proportion" id="proportion" class="checkbox">
                            </div>
                     </div>

                        <div class="col-md-2"> 
                            <div class="form-group">
                                <label for="Width">Width</label>

                                {{ Form::text('Width', null, ['placeholder' => 'Width', 'id' => 'width', 'class' => 'form-control']) }}
                        
                            </div>
                         </div>


                            <div class="col-md-3"> 
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

                        </div>



                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="RequriedClr">Required Color</label>
                                    {{ Form::text('RequriedClr', null, ['placeholder' => 'Required Color', 'class' => 'form-control']) }}

                                </div>

                            </div>



                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label for="ClrNum">Number of Colours</label>
                                    {{ Form::text('NumofClr', null, ['placeholder' => 'Number of Colors', 'class' => 'form-control']) }}

                                </div>

                            </div>

                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>Do you require seperation?</label>

                                    {{ Form::select('ReqSep', array(                     '' => 'Select',
                                                                                        'Yes' => 'Yes',
                                                                                        'No' => 'No',
                                                                                        'Not Sure' => 'Not Sure'),
                                                         'Not Sure', array('class' => 'form-control')) }}
                                </div>

                            </div>


                        </div>





                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="instraction">Addtional Instructions</label>
                                        {{ Form::textarea('AddIns', null, ['placeholder' => 'Addtional Instructions', 'class' => 'form-control', 'row' => '5']) }}
                                    </div>

                                </div>

                            </div>





                            <div class="row">

                                <div class="col-md-4"> 


                                </div>  <!--Col Close-->

                                <div class="col-md-8">   

                                </div>

                            </div><!--Col Close-->		


                        </div><!--Row Close-->


                        <div class="row">
                            <div class="col-md-12">
                                <label for="Filesattach" rows="2"><b> Files </b>  (MAXIMUM SIZE: 10MB):</label>
                                 <label style="color: blue">Upload Minimum one file</label>
                            </div>
                        </div> 



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attachment 1</label>
                                    {{ Form::file('FileOne') }}
                                </div>
                            </div> <!--Col Close-->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attachment 2</label>
                                    {{ Form::file('FileTwo') }}
                                </div>

                            </div><!--Col Close-->
                        </div> <!--Row Close-->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attachment 3</label>
                                    {{ Form::file('FileThree') }}
                                </div>
                            </div> <!--Col Close-->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Attachment 4</label>
                                    {{ Form::file('FileFour') }}
                                </div>

                            </div><!--Col Close-->
                        </div> <!--Row Close-->







                          <div class="row">

                                            <div class="col-md-6">
                                                         
                                                         <div class="form-group">

                                                     <label for="Filesattach" rows="2"><b>Order Type</b></label>
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

                </form>

                {!! FORM::close() !!}





                <!-- 
                                        
                                     {!! FORM::close() !!}
                
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
    <script type="text/javascript" src="{{ asset('assets/web/js/jQuery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/bootstrap.js') }}"></script>
    <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
    <script type="text/javascript" src="{{ asset('assets/web/js/appear.js') }}"></script>
    <!--Portfolio-->
    <script type="text/javascript" src="{{ asset('assets/web/js/isotope.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/spsimpleportfolio.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/featherlight.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/jquery.shuffle.modernizr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/steller.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/smooth-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/custom.js') }}"></script>
    <script>
        const aspectRatio = 16 / 9; // Default aspect ratio, change as needed
        function calculateProportion($changedInput, $otherInput, calculate) {
            // const value = parseFloat($changedInput.val());
            // if (!isNaN(value)) {
            //     const calculatedValue = Math.round(calculate(value));
            //     $otherInput.val(calculatedValue);
            // }
            if ($changedInput.val()) {
                $otherInput.val('');
            }

        }

        $(document).ready(function() {

            $('#width').on('keyup', function() {
                if ($('#proportion').is(':checked')) {
                    calculateProportion(
                        $(this),
                        $('#height'),
                        width => width / aspectRatio
                    );
                }
            });

            $('#height').on('keyup', function() {
                if ($('#proportion').is(':checked')) {
                    calculateProportion(
                        $(this),
                        $('#width'),
                        height => height * aspectRatio
                    );
                }

            });

            $('#proportion').on('change', function() {
                if ($(this).is(':checked')) {
                    calculateProportion(
                        $('#height'),
                        $('#width'),
                        height => height * aspectRatio
                    );
                }
            });
        });
    </script>
</body>


<!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
</html>
