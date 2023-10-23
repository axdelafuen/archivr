```plantuml
title "Architecture :"

left to right direction

frame "ArchiVR" {

node web as "Web Page" #lightgrey

node mobile as "Mobile App" #lightgrey

cloud Server #aliceblue;line:blue;line.dotted;text:blue{

node modelApi as "Web API - Model"#lightgrey{
artifact Model
}

node datasApi as "Web API - Datas" #lightgrey

database db as "Database"#lightgray{
artifact Datas
}
}


web --> Model
mobile --> Model

web --> datasApi
mobile --> datasApi

datasApi --> Datas

}
```