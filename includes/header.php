<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                        </tr>
                        <tr>
                        <td align="left"  valign="top" align='center'>
                        <div class="header_panel" valign="top"  > <h3>
                        <img height='30' width='180' src="<?php echo $web_path; ?>images/dt_png.png" alt="DT">
                        <!-- Devendra Textiles --> </h3>
                          </div>
                        </td>
                        
                            
                            <td align="center">&nbsp;
                            </td>
                             <td align="right" valign="top">
                             <div style="padding-right:15px; padding-top:10px;">
                             
                        <?php 
                        $user_type_ar_head=array('Admin' => 'admin',
                        'User' => 'user',
                        'Master' =>'master'
                    );
                          $role_id="";
                          if(isset($_SESSION['ROLEID'])){
                            $role_id=$_SESSION['ROLEID'];
                          }
                          //$disp_role_name=$role_id;
                          $disp_role_name=array_search($role_id,$user_type_ar_head);
                        
                        if($_SESSION['LOGID']) {
                          echo " <strong>Welcome ".$_SESSION['USER_NAME']."(".$disp_role_name.")</strong> &nbsp;"; 
                          //echo "| <a href='$web_path"."change_password.php'>Change Password</a>&nbsp";
                          echo "| <a href='".$web_path."login/logout.php'>Logout</a>";
                        } /*else {
                          echo " <a href='".$web_path."login.php'>login</a>";
                        }*/
          						  ?>

                          	</div>
                         </td>
                        </tr>
                    </table>
