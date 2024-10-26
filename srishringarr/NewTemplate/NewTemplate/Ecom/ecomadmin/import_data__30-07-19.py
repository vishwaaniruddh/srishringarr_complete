from django.views.generic import TemplateView
from Ecom.settings import STATIC_PATH, STATIC_DIR_PATH
import csv
from django.db import connection
from ecomadmin.models import Category,ImportCategory,Products
from django.shortcuts import get_object_or_404
from ecomauth.models import userDetails
import codecs
import os
import string
from decimal import Decimal

def dictfetchall(cursor):
    "Return all rows from a cursor as a dict"
    columns = [col[0] for col in cursor.description]
    return [
        dict(zip(columns, row))
        for row in cursor.fetchall()
    ]

class ImportData(TemplateView):
    template_name = 'ecomadmin/import.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.POST.get('import', False) == 'Import':
            file = request.FILES['file']
            filename = file._get_name()
            filedirectory = STATIC_PATH + '/import/'
            # import os,inspect
            # path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error.txt"
            # file = open(path,"w+")                
            # file.write(str(filedirectory))
            # file.close()
            if not os.path.exists(filedirectory):
                os.makedirs(filedirectory)
            filepath = STATIC_PATH + '/import/' + filename
            with open(filepath, 'wb+') as dest:
                for chunk in file.chunks():
                    dest.write(chunk)
            if postdata.get('import_type') == 'category':
                importCat(file)
            elif postdata.get('import_type') == 'product':
                if postdata.get('import_prod') == 'jewellery':
                    importProdJew(file)
                elif postdata.get('import_prod') == 'apparels':
                    importProdApp(file)              
        
        responseData = super(ImportData, self).get(request, *args, **kwargs)     
        return  responseData
    
    def get_context_data(self, **kwargs):
        context = super(ImportData, self).get_context_data(**kwargs)
        return context
    
def importCat(file):
    filename = file._get_name()
    csvfile = STATIC_PATH + '/import/' + filename
    with open(csvfile, 'r') as data_file:
        reader = csv.reader(data_file)
        for row in reader:
            importcat = ImportCategory()
            importcat.name = row[0]
            print("7777777777777777777777777777")
            print(row[0])
            importcat.slug = row[1]
            print(row[1])
            importcat.desc = row[2]
            print(row[2])
            importcat.is_active = True if row[3] == '1' else False
            print(row[3])
            importcat.is_delete = True if row[4] == '1' else False
            print(row[4])
            importcat.met1a_keywords = row[5]
            print(row[5])
            importcat.meta_desc = row[6]
            print(row[6])
            importcat.commission = row[7]
            print(row[7])
            importcat.img = row[8]
            print(row[8])
            importcat.thumb_img = row[9]
            print(row[9])
            importcat.ordering = row[10]
            print(row[10])
            importcat.parent = row[11]
            print(row[11])
#             importcat.user = row[12]
            importcat.user = 'shrawan@nucleusads.com'
            importcat.is_rent = True if row[13] == '1' else False
            importcat.is_sale = True if row[14] == '1' else False            
            importcat.save()
        importCats = ImportCategory.objects.all()
        for ic in importCats:            
            try:
                userDb = get_object_or_404(userDetails,email=ic.user)
            except:
                userDb = None
#             userDb = get_object_or_404(userDetails,email=ic.user)
           
            if userDb:
                category = Category()
                category.name = ic.name                
                if ic.parent != '0':              
                    category.parent = get_object_or_404(Category,name=ic.parent)
                category.slug = ic.slug
                category.description = ic.desc
                
                category.is_active = ic.is_active
                category.is_delete = ic.is_delete
                category.meta_keywords = ic.meta_keywords
                category.meta_description = ic.meta_desc
                category.commission = ic.commission
                category.image = ic.img
                category.thumbnail = ic.thumb_img
                category.order = ic.ordering
                category.user = userDb
                category.is_rent = ic.is_rent
                category.is_sale = ic.is_sale
                print("lasttttttttttt")
                category.save()
        ImportCategory.objects.all().delete()        
        
                

# def importCat(file):
#     filename = file._get_name()
#     csvfile = STATIC_PATH + '/import/' + filename
#     with open(csvfile, 'r') as data_file:
#         reader = csv.DictReader(data_file)
#         for row in reader:
#             dictData = dict(row)
#             importcat = ImportCategory()
#             importcat.name = dictData['name']
#             importcat.slug = dictData['slug']
#             importcat.desc = dictData['description']
#             importcat.is_active = dictData['is_active']
#             importcat.is_delete = dictData['is_delete']
#             importcat.meta_keywords = dictData['meta_keywords']
#             importcat.meta_desc = dictData['meta_description']
#             importcat.commission = dictData['commission']
#             importcat.img = dictData['image']
#             importcat.thumb_img = dictData['thumbnail']
#             importcat.ordering = dictData['ordering']
#             importcat.parent = dictData['parent']
#             importcat.user = dictData['user']
#             importcat.is_rent = dictData['is_rent']
#             importcat.is_sale = dictData['is_sale']
#             importcat.save()
#         importCats = ImportCategory.objects.all()
#         for ic in importCats:
#            
#             try:
#                 userDb = get_object_or_404(userDetails,email=ic.user)
#             except:
#                 userDb = None
#             if userDb:
#                 category = Category()
#                 category.name = ic.name
#                 if ic.parent != '0':
#                     category.parent = get_object_or_404(Category,name=ic.parent)
#                 category.slug = ic.slug
#                 category.description = ic.desc
#                 category.is_active = ic.is_active
#                 category.is_delete = ic.is_delete
#                 category.meta_keywords = ic.meta_keywords
#                 category.meta_description = ic.meta_desc
#                 category.commission = ic.commission
#                 category.image = ic.img
#                 category.thumbnail = ic.thumb_img
#                 category.order = ic.ordering
#                 category.user = userDb
#                 category.is_rent = ic.is_rent
#                 category.is_sale = ic.is_sale
#                 category.save()

def importProdJew(file):
    print("Jewellery")
    cursor = connection.cursor()
    cursor.execute('''  CREATE TABLE import_prod (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    sku_code varchar(50),
    studio_price varchar(50),
    main_image varchar(255),
    angle_images varchar(455),
    publish varchar(10),
    is_best_seller varchar(20),
    is_featured_product varchar(20),
    small_desc varchar(100),
    long_desc longtext,
    highlights longtext,
    services varchar(255),
    specifications varchar(255),
    brand_color varchar(100),
    size varchar(50),
    category varchar(100),
    sub_category varchar(100),
    ideal_for varchar(100),
    brand varchar(100),
    type varchar(100),
    inventory varchar(100),
    sleeve varchar(50),
    neck_front varchar(50),
    neck_back varchar(50),
    opening varchar(50),
    fit varchar(50),
    style varchar(50),
    weave_type varchar(50),
    pattern varchar(50),
    embellished varchar(50),
    embroidered varchar(50),
    occasion varchar(50),
    age_group varchar(50),
    metal_base varchar(50),
    in_the_box varchar(50),
    back_lock varchar(50),
    seller varchar(100),
    designer varchar(100),
    warranty varchar(100),
    fabric_material longtext,
    fabric_care longtext,
    ean_upc varchar(100),
    vat varchar(100),
    product_length varchar(50),
    product_width varchar(50),
    measuring_unit varchar(50),
    dimension_unit varchar(50),
    package_length varchar(50),
    package_width varchar(50),
    package_height varchar(50),
    package_weight varchar(50),
    pack_of varchar(200),
    sales_package varchar(200),
    meta_desc longtext,
    meta_keywords longtext,
    disclaimer varchar(255),
    is_rent varchar(100),
    is_sell varchar(10),
    categories_id int(10),
    PRIMARY KEY (id)
); ''')
    filename = file._get_name()
    csvfile = STATIC_DIR_PATH + '/import/' + filename
    with open(csvfile, 'r') as data_file:
        reader = csv.reader(data_file)   
        # print("*****************2222222222*****")     
        for row in reader:
            
            # for i in range(len(row)):
            #     print(i, "--", row[i])


        # print("*****************22222222222*****")
        # origional code
#             if row[0] != 'name':
#                 cursor = connection.cursor()
#                 query = ''' INSERT INTO import_prod (name,sku_code,studio_price,main_image,angle_images,publish,is_best_seller,is_featured_product,small_desc,long_desc,highlights,services,specifications,brand_color,category,sub_category,ideal_for,brand,type,inventory,metal_base,in_the_box,back_lock,seller,designer,warranty,fabric_material,fabric_care,ean_upc,vat,product_length,product_width,measuring_unit,dimension_unit,package_length,package_width,package_height,package_weight,pack_of,sales_package,meta_desc,meta_keywords,disclaimer,is_rent,is_sell
# ) VALUES ("{0}","{1}","{2}","{3}","{4}","{5}","{6}","{7}","{8}","{9}","{10}","{11}","{12}","{13}","{14}","{15}","{16}","{17}","{18}","{19}","{20}","{21}","{22}","{23}","{24}","{25}","{26}","{27}","{28}","{29}","{30}","{31}","{32}","{33}","{34}","{35}","{36}","{37}","{38}","{39}","{40}","{41}","{42}","{43}","{44}") '''.format(row[0], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8], row[9], row[10], row[11], row[12], row[13], row[14], row[15], row[16], row[17], row[18], row[19], row[20], row[21], row[22], row[23], row[24], row[25], row[26], row[27], row[28], row[29], row[30], row[31], row[32], row[33], row[34], row[35], row[36], row[37], row[38], row[39], row[40], row[41], row[42], row[43], row[44])
#                 cursor.execute(query)

            if row[0] != 'name':
                cursor = connection.cursor()
                query = ''' INSERT INTO import_prod (name,sku_code,studio_price,main_image,angle_images,publish,
                is_best_seller,is_featured_product,small_desc,long_desc,highlights,services,specifications,
                brand_color,size,category,sub_category,ideal_for,brand,type,inventory,sleeve,neck_front,neck_back,opening,fit,
                style,weave_type,pattern,embellished,embroidered,occasion,age_group,metal_base,in_the_box,back_lock,
                seller,designer,warranty,fabric_material,fabric_care,ean_upc,vat,product_length,product_width,
                measuring_unit,dimension_unit,package_length,package_width,package_height,package_weight,pack_of,
                sales_package,meta_desc,meta_keywords,disclaimer,is_rent,is_sell,categories_id) 
                VALUES ("{0}","{1}","{2}","{3}","{4}","{5}","{6}","{7}","{8}","{9}","{10}","{11}","{12}","{13}",
                "{14}","{15}","{16}","{17}","{18}","{19}","{20}","{21}","{22}","{23}","{24}","{25}","{26}","{27}",
                "{28}","{29}","{30}","{31}","{32}","{33}","{34}","{35}","{36}","{37}","{38}","{39}","{40}","{41}",
                "{42}","{43}","{44}","{45}","{46}","{47}","{48}","{49}","{50}","{51}","{52}","{53}","{54}","{55}"
                ,"{56}","{57}","{58}") '''.format(
                    row[0], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8],
                    row[9], row[10], row[11], row[12], row[13],row[14], row[15], row[16], row[17], row[18], 
                    row[19], row[20], row[21], row[22], row[23], row[24], row[25], row[26], row[27], row[28], 
                    row[29], row[30], row[31], row[32], "", "", "", row[33], row[34], 
                    row[35], row[36], row[37], row[38], row[39], "", "",row[40], row[41], row[42], row[43],
                    row[44], row[45], row[46], row[47], row[48], row[49], row[50], row[51], row[52], row[53])
                
                print("11111111111111111111")
                print(query)
                print("222222222222222222222")
                cursor.execute(query)


               
        cursor.execute(''' Select * from import_prod ''')
        importProdsJew = dictfetchall(cursor)
        for ipj in importProdsJew:
            products = Products()
            products.name  = ipj['name']
            print("1111111111111111111111111111111111111111111111111111111111")
            products.sku  = ipj['sku_code']
            print("22222222222222222222222222222222222222222222222222222")
            products.mrp  = ipj['studio_price']
            print("3333333333333333333333333333333333333333333333333333333333")
            products.product_image  = ipj['main_image']
            print("444444444444444444444444444444444444444444444444444444444")
            products.product_thumb_image  = ipj['angle_images']
            print("55555555555555555555555555555555555555555555555555555555")
            if ipj['publish'] == "1":
                products.is_active  = True
            else:
                products.is_active  = False
            print("66666666666666666666666666666666666666666666666666666")
            if ipj['is_best_seller'] == "1":
                products.is_bestseller  = True
            else:
                products.is_bestseller  = False
            print("777777777777777777777777777777777777777777777777777777777")
            if ipj['is_featured_product'] == "1":
                products.is_featured  = True
            else:
                products.is_featured  = False
                print("8888888888888888888888888888888888888888888888888888888")
            products.small_description  = ipj['small_desc']
            print("9999999999999999999999999999999999999999999999")
            products.description  = ipj['long_desc']
            print("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
            products.highlights  = ipj['highlights']
            print("bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb")
            products.services  = ipj['services']
            print("cccccccccccccccccccccccccccccc")
            products.specifications  = ipj['specifications']
            print("dddddddddddddddddddddddddddddd")
            products.color = ipj['brand_color']
            print("eeeeeeeeeeeeeeeeeeeeeeeeeeeeeee")
            print("Subcategoryyyyy")
            print(ipj['sub_category'])
            print("fffffffffffffffffffffffffffffffff")

            if ipj['sub_category']:
                try:
                    products.categories = get_object_or_404(Category,name=ipj['sub_category'])
                    print(sub_category)
                except:
                    products.categories = None
            print("gggggggggggggggggggggggggggggggggggg")
            
            products.specific_for  = ipj['ideal_for']
            print("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh")
            products.brand  = ipj['brand']
            print("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii")
            products.type  = ipj['type']
            print("jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj")
            products.quantity  = ipj['inventory']
            print("kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk")
            products.metal_base  = ipj['metal_base']
            print("llllllllllllllllllllllllllllllllll")
            products.in_the_box  = ipj['in_the_box']
            print("mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm")
            products.back_lock  = ipj['back_lock']
            print("nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn")
            products.seller  = ipj['seller']
            print("oooooooooooooooooooooooooooooooooo")
            products.designer  = ipj['designer']
            print("pppppppppppppppppppp")
            products.warranty  = ipj['warranty']
            print("qqqqqqqqqqqqqqqqqqqqqq")
            products.fabric_material  = ipj['fabric_material']
            print("rrrrrrrrrrrrrrrrrrrrr")
            products.fabric_care  = ipj['fabric_care']
            print("sssssssssssssssssssssssss")
            products.ean_upc  = ipj['ean_upc']
            print("ttttttttttttttttttttttt")
            products.vat  = ipj['vat']
            print("uuuuuuuuuuuuuuuuuuuuuu")
            products.product_length  = ipj['product_length']
            print("vvvvvvvvvvvvvvvvvvvvvvv")
            products.product_width  = ipj['product_width']
            print("wwwwwwwwwwwwwwwwwwwwwww")
            products.measuring_unit  = ipj['measuring_unit']
            print("xxxxxxxxxxxxxxxxxxxxxxx")
            products.dimension_unit  = ipj['dimension_unit']
            print("yyyyyyyyyyyyyyyyyyyyyyyyy")
            products.package_length  = ipj['package_length']
            print("zzzzzzzzzzzzzzzzzzzzzzzzzzz")
            products.package_width  = ipj['package_width']
            print("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@")
            products.package_height  = ipj['package_height']
            print("############################")
            products.package_weight  = ipj['package_weight']
            print("!!!!!!!!!!!!!!!!!!!!!!!!!!")
            products.pack_of  = ipj['pack_of']
            print("++++++++++++++++++++++++++")
            products.sales_package  = ipj['sales_package']
            print("==============================")
            products.meta_description  = ipj['meta_desc']
            print("***************************")
            products.meta_keywords  = ipj['meta_keywords']
            print("&&&&&&&&&&&&&&&&&&&&&&&&&")
            products.disclaimer  = ipj['disclaimer']
            print("^^^^^^^^^^^^^^^^^^^^^^^^^^^^^")

            if ipj['is_rent'] == "1":
                print("Trueeeeee")
                print("ipj['is_rent']",ipj['is_rent'])
                products.is_rent  = True
            else:
                print("Falsee")
                print("ipj['is_rent']",ipj['is_rent'])
                products.is_rent  = False
            products.rent_price = 0   
            if ipj['is_sell'] == "1":
                products.is_sale  = True
            else:
                products.is_sale  = False
            try:
                products.user = get_object_or_404(userDetails,email='shrawan@nucleusads.com')
            except:
                products.user = None

            #sushant
            if ipj['categories_id']:
                try:
                    products.categories = get_object_or_404(id,name=ipj['id'])
                    print("******************")
                    print(categories_id)
                    print("*******************")
                except:
                    products.categories = None
            products.categories_id  = ipj['categories_id']

            products.save()
            prepopulated_fields = "prd_"+str(products.id)
            print("jagfgcuhasdgcfugasdfcgauk")
            print(prepopulated_fields[0]+"_"+str(products.id))
            products.slug = prepopulated_fields[0]+"_"+str(products.id)
            products.save()            
        cursor.execute(''' DROP TABLE import_prod ''')
        
def importProdApp(file):
    cursor = connection.cursor()
    cursor.execute('''  CREATE TABLE import_prod (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    sku_code varchar(50),
    studio_price varchar(50),
    main_image varchar(255),
    angle_images varchar(455),
    publish varchar(10),
    is_best_seller varchar(20),
    is_featured_product varchar(20),
    small_desc varchar(100),
    long_desc longtext,
    highlights longtext,
    services varchar(255),
    specifications varchar(255),
    brand_color varchar(100),
    size varchar(100),
    category varchar(100),
    sub_category varchar(100),
    ideal_for varchar(100),
    brand varchar(100),
    type varchar(100),
    inventory varchar(50),
    sleeve varchar(50),
    neck_front varchar(100),
    neck_back varchar(100),
    opening varchar(100),
    fit varchar(100),
    style varchar(100),
    weave_type varchar(100),
    pattern varchar(100),
    embellished varchar(20),
    embroidered varchar(20),
    occasion varchar(100),
    age_group varchar(50),
    seller varchar(100),
    designer varchar(100),
    warranty varchar(100),
    fabric_material varchar(255),
    fabric_care longtext,
    dupatta_fabric varchar(255),
    ean_upc varchar(100),
    vat varchar(100),
    measuring_unit varchar(50),
    dimension_unit varchar(50),
    package_length varchar(50),
    package_width varchar(50),
    package_height varchar(50),
    package_weight varchar(50),
    pack_of varchar(50),
    sales_package varchar(50),
    meta_desc varchar(100),
    meta_keywords varchar(300),
    disclaimer varchar(255),
    is_rent varchar(10),
    is_sell varchar(10),
    PRIMARY KEY (id)
); ''')
    filename = file._get_name()
    csvfile = STATIC_PATH + '/import/' + filename
    with open(csvfile, 'r') as data_file:
        reader = csv.reader(data_file)
        for row in reader:
            if row[0] != 'name':
                cursor = connection.cursor()
                query = ''' INSERT INTO import_prod (name,sku_code,studio_price,main_image,angle_images,publish,is_best_seller,is_featured_product,small_desc,long_desc,highlights,services,specifications,brand_color,size,category,sub_category,ideal_for,brand,type,inventory,sleeve,neck_front,neck_back,opening,fit,style,weave_type,pattern,embellished,embroidered,occasion ,age_group,seller,designer,warranty,fabric_material,fabric_care,dupatta_fabric,ean_upc,vat,measuring_unit,dimension_unit,package_length,package_width,package_height,package_weight,pack_of,sales_package,meta_desc,meta_keywords,disclaimer,is_rent,is_sell
) VALUES ("{0}","{1}","{2}","{3}","{4}","{5}","{6}","{7}","{8}","{9}","{10}","{11}","{12}","{13}","{14}","{15}","{16}","{17}","{18}","{19}","{20}","{21}","{22}","{23}","{24}","{25}","{26}","{27}","{28}","{29}","{30}","{31}","{32}","{33}","{34}","{35}","{36}","{37}","{38}","{39}","{40}","{41}","{42}","{43}","{44}","{45}","{46}","{47}","{48}","{49}","{50}","{51}","{52}","{53}") '''.format(row[0], row[1], row[2], row[3], row[4], row[5], row[6], row[7], row[8], row[9], row[10], row[11], row[12], row[13], row[14], row[15], row[16], row[17], row[18], row[19], row[20], row[21], row[22], row[23], row[24], row[25], row[26], row[27], row[28], row[29], row[30], row[31], row[32], row[33], row[34], row[35], row[36], row[37], row[38], row[39], row[40], row[41], row[42], row[43], row[44], row[45], row[46], row[47], row[48], row[49], row[50], row[51], row[52], row[53])
                cursor.execute(query)
        cursor.execute(''' Select * from import_prod ''')
        importProdsApp = dictfetchall(cursor)
        for ipa in importProdsApp:
            products = Products()
            products.name  = ipa['name']
            products.sku  = ipa['sku_code']
            products.mrp  = ipa['studio_price']
            products.product_image  = ipa['main_image']

            products.product_thumb_image  = ipa['angle_images']
            if ipa['publish'] == "1":
                products.is_active  = True
            else:
                products.is_active  = False
                
            if ipa['is_best_seller'] == "1":
                products.is_bestseller  = True
            else:
                products.is_bestseller  = False
                
            if ipa['is_featured_product'] == "1":
                products.is_featured  = True
            else:
                products.is_featured  = False
            products.small_description  = ipa['small_desc']
            products.description  = ipa['long_desc']
            products.highlights  = ipa['highlights']
            products.services  = ipa['services']
            products.specifications  = ipa['specifications']
            products.color = ipa['brand_color']
            products.size  = ipa['size']
            try:
                products.categories = get_object_or_404(Category,name=ipa['sub_category'])
            except:
                products.categories = None
            products.specific_for  = ipa['ideal_for']
            products.brand  = ipa['brand']
            products.type  = ipa['type']
            products.quantity  = ipa['inventory']
            products.sleeve  = ipa['sleeve']
            products.front_neck  = ipa['neck_front']
            products.back_neck  = ipa['neck_back']
            products.opening  = ipa['opening']
            products.fit  = ipa['fit']
            products.style  = ipa['style']
            products.weave_type  = ipa['weave_type']
            products.pattern  = ipa['pattern']
            products.embellished  = ipa['embellished']
            products.embroidered  = ipa['embroidered']
            products.ocassion  = ipa['occasion']
            products.age_group  = ipa['age_group']
            products.seller  = ipa['seller']
            products.designer  = ipa['designer']
            products.warranty  = ipa['warranty']
            products.fabric_material  = ipa['fabric_material']
            products.fabric_care  = ipa['fabric_care']
            products.dupatta_fabric  = ipa['dupatta_fabric']
            products.ean_upc  = ipa['ean_upc']
            products.vat  = ipa['vat']
            products.measuring_unit  = ipa['measuring_unit']
            products.dimension_unit  = ipa['dimension_unit']
            products.package_length  = ipa['package_length']
            products.package_width  = ipa['package_width']
            products.package_height  = ipa['package_height']
            products.package_weight  = ipa['package_weight']
            products.pack_of  = ipa['pack_of']
            products.sales_package  = ipa['sales_package']
            products.meta_description  = ipa['meta_desc']
            products.meta_keywords  = ipa['meta_keywords']
            products.disclaimer  = ipa['disclaimer']
            if ipa['is_rent'] == "1":
                products.is_rent  = True
            else:
                products.is_rent  = False
            if ipa['is_sell'] == "1":
                products.is_sale  = True
            else:
                products.is_sale  = False
                
            try:
                products.user = get_object_or_404(userDetails,email='shrawan@nucleusads.com')
            except:
                products.user = None
            products.save()
            prepopulated_fields = list(ipa['name'].split(" "))
            products.slug = prepopulated_fields[0]+"_"+str(products.id)
            products.save()            
        cursor.execute(''' DROP TABLE import_prod ''') 

