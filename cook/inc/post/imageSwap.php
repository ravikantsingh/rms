<html>
    <head>
        <title>Image Swap</title>
    </head>
    <body>
        <form method="post" action="imageSwap.php">
            Enter Roll Number to swap image
            <input type="text" name="roll" />
            <input type="submit" value="Swap Image" name="submit"/>
        </form>
        <?php
        include('../../../../inc/scripts/config.php');
        include('../../../../inc/scripts/functions.php');
            if(isset($_POST['submit']))
            {
                $roll=$_POST['roll'];
                echo $roll;
                $sql="SELECT * FROM `think` WHERE `rollNumber`=?";
                $sqlCheck=$dbh->prepare($sql);
                $runCheck=$sqlCheck->execute(array($roll));
                $res=$sqlCheck->fetch();
                $photo=$res['photo_id'];
                $sign=$res['sign_id'];
                echo '<table>
                    <tr>
                        <td><img src="'.HOST.'userHome/img/photo/'.$photo.'" width="150px" height="100px"></td>
                        <td><img src="'.HOST.'userHome/img/sign/'.$sign.'" width="100px" height="150px"></td>
                    </tr>';
                $sql=$dbh->prepare("UPDATE `think` SET `photo_id`=?, `sign_id`=? WHERE `rollNumber`= ?");
	            $run=$sql->execute(array( $sign, $photo, $roll));
	            $source_file = '../../../../userHome/img/photo/'.$photo;
                $destination_path = '../../../../userHome/img/sign/'.$photo;
                rename($source_file, $destination_path);
                $source_file = '../../../../userHome/img/sign/'.$sign;
                $destination_path = '../../../../userHome/img/photo/'.$sign;
                rename($source_file, $destination_path);
                $sql="SELECT * FROM `think` WHERE `rollNumber`=?";
                $sqlCheck=$dbh->prepare($sql);
                $runCheck=$sqlCheck->execute(array($roll));
                $res=$sqlCheck->fetch();
                $photo=$res['photo_id'];
                $sign=$res['sign_id'];
                echo    '<tr>
                        <td><img src="'.HOST.'userHome/img/photo/'.$photo.'" width="100px" height="150px"></td>
                        <td><img src="'.HOST.'userHome/img/sign/'.$sign.'" width="150px" height="100px"></td>
                    </tr>
                </table>';
            }
        ?>
    </body>
</html>