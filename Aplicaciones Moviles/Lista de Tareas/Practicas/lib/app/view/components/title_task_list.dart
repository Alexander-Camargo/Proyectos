
import 'package:flutter/material.dart';

class Title_task_list extends StatelessWidget {
  const Title_task_list(
      this.text, {
        super.key,
        this.color
      }
  );

  final String text;
  final Color? color;

  @override
  Widget build(BuildContext context) {
    return Text(
      text,
      style: Theme.of(context).textTheme.bodyMedium!.copyWith(
        fontSize: 18,
        fontWeight: FontWeight.w600,
        color: color
      ),
    );
  }
}
