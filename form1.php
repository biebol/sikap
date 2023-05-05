<html>
<head>
    <title>SIKAP</title>
    <style type="text/css" media="screen">
        table {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;}
        input {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;height: 20px;}
    </style>
</head>
<body>
<div style="border:0; padding:10px; width:500px; height:auto;">
<form action="action-input-data.php" method="POST" name="form-input-data">
    <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr height="46">
                <td width="10%"> </td>
                <td width="25%"> </td>
                <td width="65%"><font color="orange" size="2">Form Input Usulan Kenaikan Pangkat</font></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>NIP</td>
            <td><input type="text" name="id_nip" size="50" maxlength="30" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Nama</td>
            <td><input type="text" name="nama" size="50" maxlength="30" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Jabatan</td>
            <td><input type="text" name="jabatan" size="50" maxlength="30" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Pangkat Lama</td>
            <td><select name="pangkat lama">
                    <option value="-">- Pilih Pangkat Lama-
                    <option value="Juru Muda I/a">Juru Muda I/a
                    <option value="Pengatur Muda II/a">Pengatur Muda II/a
                    <option value="Penata Muda III/a">Penata Muda III/a
                    <option value="Penata Muda Tk.I III/b">Penata Muda Tk.I III/b
                    <option value="Penata III/c">Penata III/c
                </select></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Pangkat Baru</td>
            <td><select name="pangkat baru">
                    <option value="-">- Pilih Pangkat Baru-
                    <option value="Juru Muda I/a">Juru Muda I/a
                    <option value="Pengatur Muda II/a">Pengatur Muda II/a
                    <option value="Penata Muda III/a">Penata Muda III/a
                    <option value="Penata Muda Tk.I III/b">Penata Muda Tk.I III/b
                    <option value="Penata III/c">Penata III/c
                </select></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Jenis Kenaikan Pangkat</td>
            <td><select name="jenis kenaikan pangkat">
                    <option value="-">- Pilih Jenis KP -
                    <option value="Reguler">Reguler
                    <option value="Fungsional">Fungsional
                    <option value="Struktural">Struktural
                </select></td>
        </tr>
        </tr>
        <tr height="46">
            <td> </td>
            <td> </td>
            <td><input type="submit" name="next" value="Next">   
                <input type="reset" name="reset" value="Reset"></td>
        </tr>
    </table>
</form>
</div>
</body>
</html>