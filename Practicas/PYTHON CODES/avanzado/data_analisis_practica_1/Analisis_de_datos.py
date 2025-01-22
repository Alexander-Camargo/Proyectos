import pandas as pd
import os
import matplotlib.pyplot as plt
import seaborn as sns

# Lectura
#from google.colab import drive -- Solo es necesario si se esta en google colab
#drive.mount('/gdrive')

ruta = "C:/Users/DESKTOP_ALEX/Downloads/dataset_banco.csv"

if not os.path.exists(ruta):
    print(f"El archivo {ruta} no existe. Verifica la ruta.")
else:
    data = pd.read_csv(ruta)

# Muestra las dimensiones del DataFrame (número de filas y columnas)
# print(data.shape)

# Muestra las primeras 10 filas del DataFrame para inspeccionar los datos
# print(data.head(10))

# Elimina todas las filas que contengan valores nulos y guarda los cambios en el mismo DataFrame
data.dropna(inplace=True)

# Muestra un resumen general del DataFrame: tipos de datos, número de valores no nulos y uso de memoria
print(data.info())

# Conteo de los niveles en las diferentes columnas categóricas
cols_cat = ['job', 'marital', 'education', 'default', 'housing',
       'loan', 'contact', 'month', 'poutcome', 'y']

for col in cols_cat:
  # Muestra el número de valores únicos (categorías distintas) en la columna especificada
  print(f'Columna {col}: {data[col].nunique()} subniveles')

# Genera un resumen estadístico de las columnas numéricas del DataFrame:
# print(data.describe())

print(f'Tamaño del set antes de eliminar las filas repetidas: {data.shape}')
data.drop_duplicates(inplace=True)
print(f'Tamaño del set después de eliminar las filas repetidas: {data.shape}')

# data.shape sirve para ver el tamaño del set se datos (columnas x filas)

# Eliminar filas con "age">100
print(f'Tamaño del set antes de eliminar registros de edad: {data.shape}')
data = data[data['age']<=100]
print(f'Tamaño del set después de eliminar registros de edad: {data.shape}')

# Eliminar filas con "duration" <0 (negativa)
print(f'Tamaño del set antes de eliminar registros de duración: {data.shape}')
data = data[data['duration']>0]
print(f'Tamaño del set después de eliminar registros de duración: {data.shape}')

# Eliminar filas con "previous">100
print(f'Tamaño del set antes de eliminar registros de previous: {data.shape}')
data = data[data['previous']<=100]
print(f'Tamaño del set después de eliminar registros de previous: {data.shape}')


# Generar gráficas individuales pues las variables numéricas
# están en rangos diferentes
cols_num = ['age', 'balance', 'day', 'duration', 'campaign',
            'pdays', 'previous']

fig, ax = plt.subplots(nrows=7, ncols=1, figsize=(8,30))
fig.subplots_adjust(hspace=0.5)

for i, col in enumerate(cols_num):
    sns.boxplot(x=col, data=data, ax=ax[i])
    ax[i].set_title(col)

# Mostrar las gráficas
plt.show()

output_dir = "C:/xampp/htdocs/Proyectos/Practicas/PYTHON CODES/avanzado/data_analisis_practica_1/graficas"

output_path = os.path.join(output_dir, "boxplots.png")
fig.savefig(output_path, dpi=300, bbox_inches="tight")
