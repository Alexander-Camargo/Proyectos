

import 'package:flutter/material.dart';
import 'package:practica_1_todo_list/app/Model/task.dart';
//import 'package:practica_1_todo_list/app/repository/task_repository.dart';
import 'package:practica_1_todo_list/app/view/components/shape.dart';
import 'package:practica_1_todo_list/app/view/components/title_task_list.dart';
import 'package:practica_1_todo_list/app/view/task_list/task_provider.dart';
import 'package:provider/provider.dart';

class TaskListPages extends StatelessWidget {
  const TaskListPages({super.key});

  @override
    Widget build(BuildContext context) {
    
    return ChangeNotifierProvider(
      create: (_) => TaskProvider()..fetchTasks(),
      child: Scaffold(
        body: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const _Header(),
            Expanded(child: _TaskList(),),
          ],
        ),
      
        floatingActionButton: Builder(
          builder: (context) => FloatingActionButton(
            onPressed: () => _showNewTaskModal(context), //aqui lo declaro funcion anonima con () =>
            child: const Icon(Icons.add, size: 50),
          ),
        ),
      
      ),
    );
  }

  //funciones y widgets para el almacenamiento de los datos en el telefono
  void _showNewTaskModal(BuildContext context) {
    showModalBottomSheet(
        context: context,
        //para que que la ventana desplegada por el Modal se ajuste a los elementos que contiene
        isScrollControlled: true,
        builder: (_) => ChangeNotifierProvider.value(
          value: context.read<TaskProvider>(),
          child: _NewTaskModal(),
        ),
    ); //necesito crear un widget para _NewTaskModal
  }
}


//ventana que se despliega para añadir una nueva tarea
class _NewTaskModal extends StatelessWidget {
  _NewTaskModal({super.key});

  final _controller = TextEditingController();//controlador para obtener y gudardar el texto que introduzca el usuario

  @override
  Widget build(BuildContext context) {
    return Container( // para el boton elevado a la hora de agregar una nueva tarea

      padding: const EdgeInsets.symmetric( //el contenedor permite esto sin agregar un nuevo widget
          horizontal: 33,
          vertical: 23
      ),

      //para agregar los border redondeados:
      decoration: const BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.vertical(top: Radius.circular(21)),
      ),

      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,//aliniar las cosas a algun lado este caso el inicio o izquierda
        mainAxisSize: MainAxisSize.min, // para que ocupe el minimo espacio
        children: [
          const Title_task_list('Nueva Tarea'),
          const SizedBox(height: 26),

          TextField(
            controller: _controller,//para poder usar el controlador que me permite obtener el texto introducido
            decoration: InputDecoration(
              filled: true, //habilitar el fondo como un relleno
              fillColor: Colors.white, //darle color a ese relleno
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(16)
              ),
              hintText: 'Descripcion de la tarea',
            ),
          ),//campo para que el usuario agregue texto
          const SizedBox(height: 26),

          ElevatedButton(//boton de guardar
              onPressed: (){
                if(_controller.text.isNotEmpty){//verificar que no este vacio para agregar una nueva tarea
                  final task = Task(_controller.text);
                  context.read<TaskProvider>().addNewTask(task);
                  Navigator.of(context).pop();//para cerrar la pestaña de "agregar nueva trarea"
                }
              },
              child: const Text('Guardar'),
          )
        ],
      ),
    );
  }
}


//Widgets para la vista de la lista de tareas
class _TaskList extends StatelessWidget {
  const _TaskList({super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 25),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Title_task_list('Tareas'),
          Expanded(
            child: Consumer<TaskProvider>(
              builder: (_, provider, __){
                if(provider.taskList.isEmpty){
                  return const Center(
                    child: Text('No hay tareas')
                  );
                }
                return ListView.separated( // "separated es para renderizar witgets"
                    itemCount: provider.taskList.length, //tamaño de la lista de tareas
                    separatorBuilder: (_, __) =>  const SizedBox(height: 16), // un separador que recibe el contexto y el indice del elemento que se esta renderizando
                    itemBuilder: (_, index) => _TaskItem(
                      provider.taskList[index],
                      onTap: () => provider.onTaskDoneChange(provider.taskList[index]),
                    )
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}


//contenedor del encabezado
class _Header extends StatelessWidget {
  const _Header();
  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      color: Theme.of(context).colorScheme.primary, // asignarle el color "primary" al contenedor

      child: Column(
        children: [
          const Row(children: [Shape()]),
          Column(
            children: [
              Image.asset(
                'assets/images/tasks-list-image.png',
                width: 120,
                height: 120,
              ),
              const SizedBox(height: 16),
              const Title_task_list('Completa tus tareas', color: Colors.white),
              const SizedBox(height: 25),
            ],
          )
        ],
      ),
    );
  }
}


//Widgets para la vista de las tareas
class _TaskItem extends StatelessWidget {
  const _TaskItem(this.task, {this.onTap});

  final Task task;
  final VoidCallback? onTap;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,

      child: Card(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(21)
        ),
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 21, vertical: 18),
          child: Row(
            children: [
              Icon(
                task.done
                    ? Icons.check_box_rounded
                    : Icons.check_box_outline_blank,

                color : Theme.of(context).colorScheme.primary,
              ),
              Text(task.title),
            ],
          ),
        ),
      ),
    );
  }
}

