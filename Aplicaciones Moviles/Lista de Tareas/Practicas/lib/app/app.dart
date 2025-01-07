
import 'package:flutter/material.dart';
// import 'package:practica_1_todo_list/app/view/home/home_page.dart';
import 'package:practica_1_todo_list/app/view/home/inherited_widgets.dart';
import 'package:practica_1_todo_list/app/view/splash/splash_page.dart';

import 'view/home/state_dif.dart';
// import 'package:practica_1_todo_list/app/view/task_list/task_list_page.dart';

class MyApp extends StatelessWidget {
  const MyApp({super.key});
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    
    const primary = Color(0xFF40B7AD);
    const textColor = Color(0xFF4A4A4A);
    const backgroundColor = Color(0xFFF5F5F5);
        
    return SpecialColor(
      color: Colors.redAccent,
      child: MaterialApp(
        title: 'Flutter Demo',
        debugShowCheckedModeBanner: false, // para desaparecer el icono de debug
      
        theme: ThemeData(
      
          colorScheme: ColorScheme.fromSeed(
            seedColor: primary,
            primary: primary,
            secondary: primary,
          ),
      
          scaffoldBackgroundColor: backgroundColor,
          textTheme: Theme.of(context).textTheme.apply(
            fontFamily: 'Poppins',
            bodyColor: textColor,
            displayColor: textColor
          ),
      
          bottomSheetTheme: BottomSheetThemeData( //definir el color del fondo de los Modales
            backgroundColor: Colors.transparent,
          ),
          
          elevatedButtonTheme: ElevatedButtonThemeData(
            style: ElevatedButton.styleFrom(
              minimumSize: const Size(
                  double.infinity, //define el ancho
                  54, //define el alto
              ),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(10)
              ),
              textStyle: Theme.of(context).textTheme.bodyMedium!.copyWith(
                fontSize: 18,
                fontWeight: FontWeight.w700,
              ),
            ),
          ),
      
        ),
        home: const SplashPage(),
      ),
    );
  }
}