<?php
error_reporting(0);
header("Refresh:15;url=cache/" . getSubstr($_FILES["file"]["name"],'','.res') . ".zip");
// ����Ӧ���� echo "<meta name="\"viewport"\" content="\"width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"\">"
$allowedExts = array("res");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // ��ȡ�ļ���׺��
if ((($_FILES["file"]["type"] == "text/plain")
|| ($_FILES["file"]["type"] == "application/octet-stream")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2*1024*1024)   // С�� 2MB
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "����: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "�ϴ��ļ���: " . $_FILES["file"]["name"] . "<br>";
        echo "���������ڴ�������ļ����Ժ���Զ�����zipѹ������" . "<br>";
        
		
        
        
        // �жϵ���Ŀ¼�µ� upload Ŀ¼�Ƿ���ڸ��ļ�
        // ���û�� upload Ŀ¼������Ҫ��������upload Ŀ¼Ȩ��Ϊ 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " �ļ��Ѿ����ڡ� ";
        }
        else
        {
            // ��� upload Ŀ¼�����ڸ��ļ����ļ��ϴ��� upload Ŀ¼��
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "�ļ��洢��: " . "upload/" . $_FILES["file"]["name"];
			echo "<br>";
			echo "�����ĵȴ�Լ15��<br>";
        }
    }
}
else
{
    echo "�Ƿ����ļ���ʽ";
	echo $_FILES["file"]["type"];
}
getSubstr($_FILES["file"]["name"],'','.res');
 
/*������ȡ�м��ı��ĺ��� 
  getSubstr=��������
  $str=Ԥȡȫ�ı� 
  $leftStr=����ı�
  $rightStr=�ұ��ı�
*/
function getSubstr($str, $leftStr, $rightStr)
{
    $left = strpos($str, $leftStr);
    //echo '���:'.$left;
    $right = strpos($str, $rightStr,$left);
    //echo '<br>�ұ�:'.$right;
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}
?>