<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cálculo Huella de Carbono</title>
</head>
<body>
    <form action ="huella_carbono.php" method = "post" name "calclular algo no se">
        <h1>Test para el cálculo de la huella ecológica</h1><br>

        ¿Cuántos automoviles hay en tu casa?<input type="text" name="autos"/><br>
        <p></p>
        ¿Cuántos litros de gasolinan cargan a la semana?<input type="text" name="litros"/><br>
        <p></p>
        Consumo de gas natural bimestral<input type="text" name="gas"/><br>
        <p></p>
        Consumo de elctricidad anual<input type="text" name="luz"/><br>
        <p></p>
        <h2>Calcula el impacto que haces al viajar de tu casa/escuela</h2>

        Tipo de transporte que usas:<br>
        <input type = "radio" name = "transporte"/>Autos<br>
        <input type = "radio" name = "transporte"/>Lobus
        <p></p>
        distancia de tu casa a la escuela<input type="text" name="distancia"/><br>
        <p></p>
        rendimiento de tu carro<input type="text" name="rendimiento" /><br>
        <p></p>
        <input type="submit" name="btnenviar" value="Calcular"/>
    </form>    
      
</body>

        <?php
        //posts para traer datos de los textbox
        $autos = $_POST['autos'];
        $litros = $_POST['litros'];
        $gas = $_POST['gas'];
        $luz = $_POST['luz'];
        $distancia = $_POST['distancia'];
        $rendimiento = $_POST['rendimiento'];

        //valores que ya estaban definidos
        $bimestres = 6;
        $semanas = 52;
        $gasolina = 2.2;
        $rendimiento_lobus = 10.54; 

        //calculo de la huella de carbono de los autos en toneladas, creo 
        $carros = $autos*$litros*$semanas*$gasolina;
        
        //calculo de la huella de carbono del gas natural
        $gas_natural = $gas*$bimestres;
        $m_to_mj = $gas_natural*46235.2;
        $mj_to_tj = $m_to_mj/1000000;
        $tj_to_co2 = $mj_to_tj*56100;
        $tj_to_ch4 = $mj_to_tj*28;
        $tj_to_n2o = $mj_to_tj*0.1;
        $n2o_to_co2 = $tj_to_n2o*265;
        $huella_kg = $n2o_to_co2 + $tj_to_ch4 + $tj_to_co2;
        $huella_ton = $huella_kg /1000;
        
        //calculo de la huella de carbono de electricidad esta es en kw / años 
        $kwh_to_mj = $luz*3.6;
        $kmj_to_ktj = $kwh_to_mj * .000001;
        $ktj_to_kco2 = $kmj_to_ktj * 56100;
        $ktj_to_kch4 = $kmj_to_ktj*28;
        $ktj_to_kn2o = $kmj_to_ktj*0.1;
        $kn2o_to_kco2 = $ktj_to_kn2o*265;
        $huella_kg_luz = $kn2o_to_kco2 + $ktj_to_kch4 + $ktj_to_kco2;
        $huella_ton_luz = $huella_kg_luz /1000;

        //para los medios de transporte, working on it
        $casa_escuela = $distancia * 2 * 5 * 52;
        $impacto_carro = ($casa_escuela / $rendimiento) * 2.2;
        $impacto_lobus = ($casa_escuela / $rendimiento_lobus) * 2.2;

        //nadamas para ver si funciona
        echo "la wea : ".$carros. " de huella digital :v<br />";
        echo "el consumo : ".$gas_natural. " de gas m3";    
        echo "<br />". $m_to_mj."mj";
        echo "<br />". $mj_to_tj."tj";
        echo "<br />". $tj_to_co2."kgco2";
        echo "<br />". $tj_to_ch4."kgch4";
        echo "<br />". $tj_to_n2o."kgn2o";
        echo "<br />". $n2o_to_co2."kgn2o a kg co2";
        echo "<br />". $huella_kg."kg / año";
        echo "<br />". $huella_ton."ton / año";

        echo "<br />". $kwh_to_mj."kw.mj"; 
        echo "<br />". $kmj_to_ktj."kw.tj";
        echo "<br />". $ktj_to_kco2."kw.kgco2";
        echo "<br />". $ktj_to_kch4."kw.kgch4";
        echo "<br />". $ktj_to_kn2o."kw.kgn2o";
        echo "<br />". $kn2o_to_kco2."kw.kgn2o";
        echo "<br />". $huella_kg_luz."kw.kg / año";
        echo "<br />". $huella_ton_luz."kw.ton / año";
        echo "<br />". $casa_escuela."km / año";
        echo "<br />". $impacto_carro."kgCO2";
        echo "<br />". ($impacto_carro / 1000)."ton / año";
        //echo "<br />". ($impacto_lobus / 1000)."ton / año, si viajaras en lobus";
        //-?echo "<br />impacto total".($carros + $huella_ton + $huella_ton_luz + ($impacto_carro / 1000))."ton / año";
        //echo "<br />impacto total".($carros + $huella_ton + $huella_ton_luz + ($impacto_lobus / 1000))."ton / año";
        
        ?>

</html>