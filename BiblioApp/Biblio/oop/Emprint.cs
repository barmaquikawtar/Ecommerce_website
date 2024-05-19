using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WindowsFormsApp1.oop
{
    public class Emprint
    {
        private int id;
        private int user_id;
        private int ouvrage_id;
        private DateTime date_retour;
        private string note;
        private DateTime created_at;

        public Emprint(int user_id, int ouvrage_id, DateTime date_retour, string note)
        {
            this.user_id = user_id;
            this.ouvrage_id = ouvrage_id;
            this.date_retour = date_retour;
            this.note = note;
        }
    }
}
