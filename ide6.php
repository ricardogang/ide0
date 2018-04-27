<!DOCTYPE html>
<html>
<body>

<style>
header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px; 
    border-radius: 7px; 
    margin:5px;
    font-family: Lucida Console, Helvetica, sans-serif;
}
aside {
    background-color:#eeeeee;
    float:left;
    padding:7px; 
    margin:5px;
    border-radius: 7px; 
    width:300px;
    color:black;
    font-family: Lucida Console, Helvetica, sans-serif;
}
section {
    margin:2px;
    background-color:#EBF5FB  ;
    float:left;
    padding:1px; 
    overflow: hidden;
    resize: both;
	border-radius: 7px; 
	min-height:520px;
}
article {
    background-color:white;
    clear:both;
    text-align:left;
    padding:5px; 
    border-radius: 7px; 
    margin:5px;
}
iframe {
    background-color:white;
    clear:both;
    text-align:left;
    padding:5px; 
    border-radius: 7px; 
    margin:5px;
    width:100%;
    height:500px;
    font-family: Lucida Console, Helvetica, sans-serif;
}
footer {
    background-color:gray;
    color:white;
    clear:both;
    text-align:center;
    padding:5px; 
    border-radius: 7px; 
    margin:5px;
    font-family: Lucida Console, Helvetica, sans-serif;
}

button {
	border-radius: 7px;
	height: 47px;
	font-family: Lucida Console, Helvetica, sans-serif;
	background: #66a9d6;

  box-shadow: 2px 3px 30px #000000;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 11px 20px 10px 21px;
  text-decoration: none;
  padding: 7px 13px 7px 13px;
  margin:7px;
  align:right;
  alignment-adjust:right;
}

button:hover{
  background: #90cef5;
  background-image: -webkit-linear-gradient(top, #90cef5, #3498db);
  background-image: -moz-linear-gradient(top, #90cef5, #3498db);
  background-image: -ms-linear-gradient(top, #90cef5, #3498db);
  background-image: -o-linear-gradient(top, #90cef5, #3498db);
  background-image: linear-gradient(to bottom, #90cef5, #3498db);
}

editor { 
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding:5px;
}

textarea { 
    padding:5px; 
    border-radius: 7px; 
}

.modal {
    display: block; 
    position: fixed; 
    z-index: 1; 
    padding-top: 100px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.p {
    font-family: Lucida Console, Helvetica, sans-serif;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<script src="ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>

window.onload= function() {
    window.resizeTo(screen.width-300,screen.height-500)  ;
}
function compile(editor) {
    var source=editor.getValue();
    var className=document.getElementById('txtClassName').value ;
    ajax("source="+source+"&className="+className+"&action=compile");
};

function compileAndRun(editor) {
    var source=editor.getValue();
    var className=document.getElementById('txtClassName').value ;
    var args=document.getElementById('txtArguments').value ;
	ajax("source="+source+"&className="+className+"&action=compileAndRun&arguments="+args);
};

function executeCmd(cmd){
    ajax("source="+cmd+"&action="+"executeCmd");
};

function ajax(msg) {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            //alert("readyState==4 and status==200");
            if (xmlhttp.responseText.length>0) {
               // alert("response="+xmlhttp.responseText);
                document.getElementById("result").value=xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("POST","basicRunner.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(msg);
};

function resultAppend(){
     var result=document.getElementById("result");
     result.value+=",";
     result.value=result.value.replace(/,$/,  "");
     result.scrollTop= result.scrollHeight;
};

function checkKey(e) {
    var unicode=e.keyCode? e.keyCode : e.charCode;
    switch (unicode) {
        case 8: case 46: 
            e.preventDefault(); 
            break ;
        case 13:
            ajax("action=sendToProcess&arguments="+"17");
            break ;
    }
    resultAppend();
}
</script>

<section>
<header>
SIMPLE JAVA IDE
</header>

<div id="avisoConsentimiento" class="modal">
  <div class="modal-content">
    <span class="cerrarConsentimiento">
        <button id="btnAceptarConsentimiento" onclick="aceptarConsentimiento()">ACEPTAR CONDICIONES</button>
        <button id="btnRechazarConsentimiento" onclick="rechazarConsentimiento()">RECHAZAR</button>
    </span><br>
    <iframe src="consentimiento.html" seamless></iframe>
  </div>
</div>

<section>
<article style="height:98px; width:260px; background-color=black ">
</article>

<article>
    <p>PROBLEMA</p>
  <select id="listaDeProblemas" size=7 style="height:150px; width:250px ">
    <option>PROBLEMA 1</option>
    <option>PROBLEMA 2</option>
    <option>PROBLEMA 3</option>
    <option>PROBLEMA 4</option>
    <option>PROBLEMA 5</option>
    <option>PROBLEMA 6</option>
    <option>PROBLEMA 7</option>
  </select>
  <BR>
<button type="btnMostrarProblema" onclick="mostrarProblema()">MOSTRAR PROBLEMA</button>
<script>
function mostrarProblema() {
    var x = document.getElementById("autoreporte").value;
    alert("PENDIENTE: MOSTRAR PROBLEMA");
};
</script>    

</article>

<footer>
<p>IDEAS</p>
<textarea style="height:150px; width:250px " id="autoreporte"></textarea><br>
<button type="btnGuardarAutoReporte" onclick="guardarAutoReporte()">REPORTE SUS IDEAS</button>
<script>
function guardarAutoReporte() {
    var x = document.getElementById("autoreporte").value;
    alert("PENDIENTE GUARDAR EN BITACORA: "+x);
}
</script>
</footer>

</section>
<section>
<header>
    <aside>
        ClassName:<input type="textbox" id="txtClassName"><br>
        Arguments:<input type="textbox" id="txtArguments">
    </aside>
    <button onclick="compile(editor);">
        COMPILE<br>
    </button>
    <button onclick="compileAndRun(editor);">
        COMPILE & RUN<br>
    </button>
</header>

<article>
<div id="editor" style="height: 300px; width: 99% " draggable="true" style="color: #C2C5C5; background-color: #777777; border-radius: 7px; ">import java.util.* ;
class ClassName {
    public static void main(String[] args) {
        System.out.println("Program started..");
        Scanner sc = new Scanner(System.in);
        
        while(sc.hasNextLine()) {
            System.out.print("INPUT RECEIVED:");
            System.out.println(sc.nextLine());
        }
        System.out.println("Program finished..");
    }
}
</div>
</article>


<script>
   var db= 'DB' ;
   var table= 'actions' ;
   
         window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
         window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
         window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
 var req = indexedDB.deleteDatabase(db);
         var request = window.indexedDB.open(db, 1);
         request.onerror = function(event) {console.log("error: ");         };
         request.onsuccess = function(event) {
            db = request.result;
            console.log("DB Database OPEN: "+ db);
         };
         
         request.onupgradeneeded = function(event) {
            var db = event.target.result;
            var objectStore = db.createObjectStore(table,{keyPath: 'id', autoIncrement: true});
         };
         
        function addToDB(action,range,text,delta,deltaType,timeStamp) {
            data= { 
                action: action, 
                range: range, 
                text:text, 
                delta: delta, 
                deltaType:deltaType, 
                timeStamp:timeStamp ,
            };
            
            var request = db.transaction([table], "readwrite");
            request.objectStore(table)
            .add(data);
            
            request.onsuccess = function(event) {
               console.log("CODERWATCH: Data added to database.");
            };
            
            request.onerror = function(event) {
               console.log("CODERWATCH: Unable to add data.");
            };
         }
         
    var timer ;
    var editor ;
    var delta=""  ;
    var deltaType="";
    var divEditor= document.getElementById("editor");
    divEditor.style.display= 'none';
    editor = ace.edit("editor");
    editor.getSession().setMode("ace/mode/java");

    editor.getSession().on('change', function(event) {
        delta+=event.data.text ;
        if (deltaType!=event.data.action){
            deltaType= event.data.action ;
            addToDB(event.data.action,event.data.range,event.data.text,event.data.delta,event.data.deltaType,Date.now());
            console.log("cambio: 0:"+event.data.action+" 1:"+event.data.range+" 2:"+event.data.text+" delta:"+delta+" deltaType:"+deltaType);
            //delta="" ;
        }
    
        clearTimeout(timer);
        timer = setTimeout(function(){
            addToDB(event.data.action,event.data.range,event.data.text,event.data.delta,event.data.deltaType,Date.now());
            console.log("cambio: 0:"+event.data.action+" 1:"+event.data.range+" 2:"+event.data.text+" delta:"+delta+" deltaType:"+deltaType);
            delta="";
        },2000);
            });
    editor.getSession().setUseSoftTabs(true);


function aceptarConsentimiento() {
    divEditor.style.display= 'block';
    //guardarDatoDeConsentimiento
    modal.style.display = "none";
}
var modal = document.getElementById('avisoConsentimiento');


var span = document.getElementsByClassName("cerrarConsentimiento")[0];
span.onclick = function() {
    modal.style.display = "none";
}

</script>
<footer>
CONSOLE:<br>
<textarea wrap="off" onclick="resultAppend();" onkeydown="checkKey(event);" id="result" style="color: #C2C5C5; background-color: #333333; border-radius: 7px;height: 250px; width:650px;"></textarea>
</footer>
</section>

<footer>ricardogang@gmail.com</footer>
</section>
</body>
</html>