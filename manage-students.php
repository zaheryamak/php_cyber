
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_SESSION['login']))    {   
    header("Location: index.php"); 
    }
    else{

?>

<link rel="stylesheet" type="text/css" href="assets/js/DataTables/datatables.min.css"/>
            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Gérer les étudiants</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Acceuil</a></li>
                                        <li> Etudiants</li>
            							<li class="active">Gérer les étudiants</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Voir les informations sur les étudiants</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
<?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nom de l'étudiant</th>
                                                            <th>Numéro de l'étudiant</th>
                                                            <th>Classe</th>
                                                            <th>Note moyenne</th>
                                                            <th>Date d'inscription</th>
                                                            <th>Etat</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
															<th>#</th>
                                                            <th>Nom de l'étudiant</th>
                                                            <th>Numéro de l'étudiant</th>
                                                            <th>Classe</th>
                                                            <th>Note moyenne</th>
                                                            <th>Date d'inscription</th>
                                                            <th>Etat</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php $sql = "SELECT tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section , avg(tblresult.marks) as note
from tblstudents 
join tblclasses on tblclasses.id=tblstudents.ClassId
left join tblresult on tblstudents.StudentId=tblresult.StudentId
Group by tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<tr>
 <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->StudentName);?></td>
                                                            <td><?php echo htmlentities($result->RollId);?></td>
                                                            <td><?php echo htmlentities($result->ClassName);?>(<?php echo htmlentities($result->Section);?>)</td>
                                                            <td><?php echo htmlentities($result->RegDate);?></td>
                                                            <td><?php echo htmlentities($result->note);?></td>
                                                             <td><?php if($result->Status==1){
echo htmlentities('Active');
}
else{
   echo htmlentities('Blocked'); 
}
                                                                ?></td>
<td>
<a href="edit-student.php?stid=<?php echo htmlentities($result->StudentId);?>" class="btn btn-info"><i class="fa fa-edit" title="Edit Record"></i> </a> 

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
<?php include('includes/footer.php');?>

        
<?php } ?>

