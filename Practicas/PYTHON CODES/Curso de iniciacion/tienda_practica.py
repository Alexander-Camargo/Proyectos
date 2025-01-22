productos = [
    ["Manzanas verdes", 5.00, 20],
    ["Manzanas Roja", 5.00, 20],
    ["Manzanas Golden", 5.00, 20],
    ["Manzanas Rosa", 5.00, 20],
    ["Manzanas Fuji", 5.00, 20]
]

name = input("Ingrese su nombre y apellido: ")

print("****************************************")
print("**********BIENVENIDO: "+name+"**********")
print("**********A NUESTRA TIENDA DE***********")
print("****************MANZANAS****************")
print("****************************************")

print("\nProductos disponibles:")
for i, producto in enumerate(productos):
    print("#"+f"{i+1}. {producto[0]} - precio: {producto[1]} - disponible: {producto[2]}")
    
manzana = int(input("\nCual manzana desea comprar ingrese el numero de product: ")) - 1

if manzana >-0:
    print(f"A seleccionado: {productos[manzana][0]}")

    cantidad = int(input("\nque cantidad de manzanas desea comprar: "))
    productos[manzana][2]-=cantidad
    
    precio = productos[manzana][1]*cantidad
    print(f"\ntotal a pagar: {precio:.2f}")
    
    print("\nProductos disponibles:")
    for i, producto in enumerate(productos):
        print("#"+f"{i+1}. {producto[0]} - precio: {producto[1]} - disponible: {producto[2]}")
    
else:
    print("\nNo selecciono un producto valido")