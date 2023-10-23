@startuml Api Management in front of AKS

title High Level Architecture - API Management in front of AKS

frame VNET{
    frame APIM-subnet{
        node "API Management"
    }
    frame AKS-subnet{
        node "ILB"
        node "AKS Cluster"
    }
}
@enduml