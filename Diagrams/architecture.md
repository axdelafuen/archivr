```plantuml
title "Architecture :"

left to right direction

frame "ArchiVR" {



cloud Server #aliceblue;line:blue;line.dotted;text:blue{

node webApp as "Web Page" #lightgrey

node api as "Web API" #lightgrey

database db as "Database"#lightgray{
artifact datas
}
}


webApp --> api
mobile --> api

api --> datas

}
```