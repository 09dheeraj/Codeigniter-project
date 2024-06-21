
<?php
       
       if($this->session->userdata('user_role') == "1")
		{
            ?>   
              
                
                </div>
</div>

     

      
      <?php
    }
    elseif($this->session->userdata('user_role') == "2"){
    ?>
     
                
                </div>
</div>
</div>

               
        
    <?php
    }else{
       ?>
      </div>
      </div>
      </div>

                     
  <?php  }
    ?>

      
  
   
 
                       

 




      </body>
</html>