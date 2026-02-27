# Filter Mapping Guide

This document explains how frontend filter options map to backend query parameters and database fields.

---

## "How often do you want to see them?" Watering (`watering`)
### **Frontend options → Backend field: `watering`**
| Frontend Label                        |  API Query Param |Stored in DB |
|---------------------------------------|------------------|-------------|
| "Barely at all"                       | Minimum          | Minimum     |
| "Once a week to every few days"       | Average          | Average     |
| "I don't mind a daily commitment"     | Frequent         | Frequent    |

---

## "How much do they like to be seen?" Sunlight (`sunlight`)
### **Frontend groups → Raw API values in DB**
| Frontend                                                             | API Query Param     | Stored in DB                                     |
|----------------------------------------------------------------------|---------------------|--------------------------------------------------|
| "I like them shy and introverted"                                    | `?sunlight=shy`     | `deep shade` OR `full shade` OR `filtered shade` |
| “Must be flexible- not too much and not too little spotlight!”       |`?sunlight=ambivert` |  `part shade` OR `part sun/partshade`            |
| “I'd like them to be the life of the party. Full spotlight, please!” |`?sunlight=extrovert`|  `full sun`                                      |


---

## "Do you like a challenge?..."  Difficulty (`difficulty`)
Frontend combines Medium + Difficult into a single category.

### **Frontend → Backend**
| Frontend                                                  | API Query Param       | Stored in DB                                    |
|-----------------------------------------------------------|-----------------------|-------------------------------------------------|
| "No. Low maintenance & emotionally stable for me, please" | `?difficulty=easy`    | `Easy` OR `Low`                                 |
| "Bring it on! I need a little fire and fireworks"         | `?difficulty=hard`    | `Medium` OR `Moderate` OR `Difficult` OR `High` |


---

## "Do they need to get along with your pets?" Pet Safety (`petSafe`)
Frontend toggle → backend boolean filter

| Frontend                                | API Query Param | Stored in DB                                      |
|-----------------------------------------|-----------------|---------------------------------------------------|
| “Yes- my pets and I are a package deal” | `?petSafe=true` | `poisonous_to_pets = 0`                           |
| “I don't have pets”                     |no filter needed | `poisonous_to_pets = 0` or `poisonous_to_pets = 1`|

---

## "Is height important to you?" Height Category (`heightCategory`)
Calculated during seeding from raw cm values.

Frontend                             | API Query Param           | Stored in DB    | 
-------------------------------------|---------------------------|-----------------|
"I like my partners short and cute"  | `?heightCategory=short`   | 0–40 cm         |
"Average & reliable, please"         | `?heightCategory=average` | 41–120 cm       |
"Tall, dark & handsome only"         | `?heightCategory=tall`    | 121+cm          |
"I'm open to all heights"            |  no filter needed         | all in cm       |

---

```

---


