
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class StatePage extends StatelessWidget {
  const StatePage({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => EmailProvider(),
      child: Scaffold(
        body: Padding(
          padding: EdgeInsets.all(50),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              _EmailTextFill(),
              const SizedBox(height: 20),
              _SendButton(),
              const SizedBox(height: 20),
              _EmailText(),
            ],
          ),
        ),
      
      ),
    );
  }
}

class _EmailText extends StatelessWidget {
  const _EmailText({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    // final email = context.watch<EmailProvider>().email; //para actualizar la variable cuando se actualice el email
    return Consumer<EmailProvider>(builder: (_, emailProvider, child){
      return Text('El Email introducido es: ${emailProvider.email}');
    });
    //return Text('El Email introducido es: $email');
  }
}

class _SendButton extends StatelessWidget {
  const _SendButton({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return ElevatedButton(//boton de guardar
      onPressed: (){},
      style: ElevatedButton.styleFrom(
        foregroundColor: Color(0xFFF5F5F5),
        backgroundColor: Theme.of(context).colorScheme.primary,
      ),
      child: const Text('Enviar'),
    );
  }
}

class _EmailTextFill extends StatelessWidget {
  const _EmailTextFill({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return TextField(
      onChanged: (value) => context.read<EmailProvider>().email = value,//para estar atento a los cambios del provider o valores que represetnta y read para leer un metodo
      decoration: InputDecoration(
        filled: true,
        fillColor: Colors.white, //darle color a ese relleno
        border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(16)
        ),
        hintText: 'Email'
      )
    );
  }
}

class EmailProvider extends ChangeNotifier{
  String _email = '';

  String get email => _email;

  set email(String value) {
    _email = value;
    notifyListeners();
  }
}