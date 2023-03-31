<?php
/***************************************************************************/
/*     PROGRAMMER     :  SREE                                              */
/*     SCRIPT NAME    :  admin_session.php                                 */
/*     CREATED ON     :  05/JUN/2008                                       */
/*                                                                         */
/*     User  Session Variables                                             */
/***************************************************************************/
        session_start();
		header("Cache-control: private");
        //for admin session
        session_register("SESS_STU_USERID"); 
		
		//$_SESSION['SESS_STU_USERID'] = 1;
		ini_set('session.cookie_path','/stallion_wms_v2');
?>