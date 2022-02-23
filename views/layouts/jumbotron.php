
 <div class="container">         		
            <div class="row">			
                <div class="col-lg-12">                    
                    <div class="jumbotron">
                        <h2>
                            <?php
                            $hora = date("g");
                            $ampm = date("a");
                            if ($ampm === "am") {
                                ?>
                                <p>¡¡ Buenos días !!</p>
                            <?php } else { ?>                    
                                <?php if ($hora < '6') { ?>                        
                                    <p>¡Buenas tardes!</p>                        
                                <?php } else { ?>                        
                                    <p>¡Buenas noches!</p>                        
                                <?php } ?>
                            <?php } ?>
                        </h2>
                        <p>Sistema  de planificación de recursos empresariales (ERP)</p>
                        <p>GRUPO WEBCOMCR SA, &copy; Jarvis <?= date('Y') ?></p>
					
                    </div>
                    <p class="pull-left"></p>
                </div>
            </div>  
<!--			
            <div class="row" style="
                 background: url(/img/m1.gif);
                 height: 78px;
                
                 ">
            </div>-->
        </div>   

