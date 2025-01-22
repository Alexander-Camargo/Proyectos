import string

texto= input("introduce la cadena de texto:\n")
texto_lower = texto.lower().translate(str.maketrans('', '', string.punctuation))

palabras = []
palabra_actual = ""

for caracter in texto_lower:
    if caracter.isalpha():
        palabra_actual += caracter
    else:
        if palabra_actual:
            palabras.append(palabra_actual)
            palabra_actual = ""

if palabra_actual:
    palabras.append(palabra_actual)

conteo = []
palabras_contadas = []

for palabra in palabras:
    if palabra not in palabras_contadas:
        palabras_contadas.append(palabra)
        contador = 0
        for p in palabras:
            if p == palabra:
                contador += 1
        conteo.append((palabra, contador))

print("\nConteo de Palabras:")
print("\nRepetidas mas de una vez:")
for palabra, cantidad in conteo:
    if cantidad > 1:
        print(f"{palabra}: {cantidad}")
        
print("\nPalabras que no se repiten:")
for palabra, cantidad in conteo:
    if cantidad == 1:
        print(f"{palabra}: {cantidad}")