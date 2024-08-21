 
Change Order Type CODE
 <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><strong>Change Order Type</strong></h3>
                                    </div>
                                     @include('includes/front_alerts')
                                    <div class="box-body m-l-250">
                                     
                                    
                                    <label for="Status" style="margin-left: 10px"><strong>Change Type:</strong></label>
                                    <div class="form-group">
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <div class="form-group">
                                    {!! Form::open(['url' => 'admin/digi-status-change/'.$DigiOrders->OrderID]) !!}
                                                    
                                                     {!! Form::select('Status', ['-1' => 'Select Order Type', '0' => 'New Order', '3' => 'Free Order', '1' => 'Revision'], null, ['class' => 'form-control']) !!}
                                                       <!-- <select class="form-control" id="Status" name="Status">
                                                            <option value="-1">Select</option>
                                                            <option value="0">New Order</option>
                                                            <option value="3">Free Order</option>
                                                            <option value="1">Revision</option>
                                                        </select> -->
                                                   </div>

                                                 </div> 
                                        
                                               <div class="col-md-6 col-sm-6 col-xs-12">  
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-block btn-primary">Update</button>
                                                </div>
                                            </div>

                                     {!! Form::close() !!}




                                        </div>
                                    
                                    </div>
                                </div>
                            </div>