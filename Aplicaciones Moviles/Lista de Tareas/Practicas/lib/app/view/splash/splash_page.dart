
import 'package:flutter/material.dart';
import 'package:practica_1_todo_list/app/view/components/shape.dart';
import 'package:practica_1_todo_list/app/view/components/title_task_list.dart';
import 'package:practica_1_todo_list/app/view/home/inherited_widgets.dart';
import 'package:practica_1_todo_list/app/view/task_list/task_list_page.dart';

class SplashPage extends StatelessWidget{
  const SplashPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
          children: [
            // Widget 'Shape' en la esquina superior derecha
            const Align(
              alignment: Alignment.topLeft,
              child: Shape(),
            ),

            // Contenido principal centrado
            Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  const SizedBox(height: 79),
                  Image.asset(
                    'assets/images/onboarding-image.png',
                    width: 180,
                    height: 168,
                  ),
                  const SizedBox(height: 99),
                  const Title_task_list('Lista de Tareas'),
                  const SizedBox(height: 21),
                  GestureDetector(
                    onTap: (){
                      Navigator.of(context).push(MaterialPageRoute(builder: (context){
                        return TaskListPages();
                      }));
                    },
                    child: const Padding(
                      padding: EdgeInsets.symmetric(horizontal: 32.0),
                      child: Text(
                        'La mejor forma para que no se te olvide nada es anotarlo. Guardar tus tareas y ve completando poco a poco para aumentar tu productividad',
                        textAlign: TextAlign.center,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
    );
  }
}