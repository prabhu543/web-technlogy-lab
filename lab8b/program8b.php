<?php
$conn = mysqli_connect("localhost", "root", "", "usn115") or die("can't connect " . mysqli_error($conn));
$res = mysqli_query($conn, "select * from studentinfo");

echo "********BEFORE SORTING**********<br><br>";
echo "<table border=1>
<tr>
    <th>id</th>
    <th>name</th>
    <th>usn</th>
    <th>branch</th>
    <th>email</th>
    <th>city</th>
</tr>";

$a = array();
while ($row = mysqli_fetch_row($res)) {
    echo "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
        </tr>
    ";
    $a[] = $row[2];
}
echo "</table><br/>";

$n = count($a);
for ($i = 0; $i < $n - 1; $i++) {
    $pos = $i;
    for ($j = $i + 1; $j < $n; $j++) {
        if ($a[$pos] > $a[$j]) $pos = $j;
    }
    if ($pos != $i) {
        $temp = $a[$i];
        $a[$i] = $a[$pos];
        $a[$pos] = $temp;
    }
}

echo "********AFTER SORTING**********<br><br>";
echo "<table border=1>
<tr>
    <th>id</th>
    <th>name</th>
    <th>usn</th>
    <th>branch</th>
    <th>email</th>
    <th>city</th>
</tr>";

for ($i = 0; $i < $n; $i++) {
    $usn = $a[$i];
    $res1 = mysqli_query($conn, "select * from studentinfo where usn='$usn'");
    $row = mysqli_fetch_row($res1);
    echo "
        <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
        </tr>
    ";
}
echo "</table>";
?>
