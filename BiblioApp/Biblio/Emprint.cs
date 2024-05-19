using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Windows.Forms;

namespace Biblio
{
    public partial class Emprint : Form
    {
        MySqlConnection conn;
        string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";
        MySqlCommand cmd;
        MySqlDataReader dr;
        private int selected_client_id =0;
        private int  selected_ouvrage_id =0;
        private int  selected_id=0;

        public Emprint()
        {
            InitializeComponent();
        }
        private void Emprint_Load(object sender, EventArgs e)
        {
            button2.Enabled = false;
            button3.Enabled = false;
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                dataGridView1.DataSource = null;
                ////client
                MySqlDataAdapter adapter3 = new MySqlDataAdapter("SELECT id,name,cin,email,phone FROM `users`"
                 , conn);
                DataTable dt3 = new DataTable();
                adapter3.Fill(dt3);
                dataGridView1.DataSource = dt3;
                dataGridView1.Columns[0].HeaderText = "Id";
                dataGridView1.Columns[1].HeaderText = "Nom";
                dataGridView1.Columns[2].HeaderText = "Cin";
                dataGridView1.Columns[3].HeaderText = "Email";
                dataGridView1.Columns[4].HeaderText = "Phone";

                dataGridView3.DataSource = null;
                ////disponible ouvrage
                MySqlDataAdapter adapter4 = new MySqlDataAdapter("SELECT id,name,type," +
                    "auteur,editeur,numero FROM `ouvrage` WHERE ouvrage.id NOT IN " +
                    "(SELECT emprints.ouvrage_id from emprints WHERE emprints.etat LIKE" +
                    " 'disponible')", conn); ;
                DataTable dt4 = new DataTable();
                adapter4.Fill(dt4);
                dataGridView2.DataSource = dt4;
                dataGridView2.Columns[0].HeaderText = "Id";
                dataGridView2.Columns[1].HeaderText = "Nom";
                dataGridView2.Columns[2].HeaderText = "Type";
                dataGridView2.Columns[3].HeaderText = "Auteur";
                dataGridView2.Columns[4].HeaderText = "Editeur";
                dataGridView2.Columns[5].HeaderText = "Numero";

                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
            displaydata();

        }

        private void displaydata()
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                dataGridView3.DataSource = null;
                ////disponible ouvrage
                ////emprint
                MySqlDataAdapter adapter2 = new MySqlDataAdapter("select e.id,u.name,u.cin,u.email," +
                 "u.phone,o.type,o.name,o.auteur,o.editeur,o.numero,e.etat,DATE_FORMAT(e.date_retour,'%m/%d/%Y') as date_retour,e.note from emprints e " +
                 "inner join ouvrage o on e.ouvrage_id =o.id inner join users u on u.id = e.user_id"
                 , conn);
                DataTable dt2 = new DataTable();
                adapter2.Fill(dt2);
                dataGridView3.DataSource = dt2;
                dataGridView3.Columns[0].HeaderText = "Id";
                dataGridView3.Columns[1].HeaderText = "Nom";
                dataGridView3.Columns[2].HeaderText = "Cin";
                dataGridView3.Columns[3].HeaderText = "Email";
                dataGridView3.Columns[4].HeaderText = "Tele";
                dataGridView3.Columns[5].HeaderText = "Type d'ouvrage";
                dataGridView3.Columns[6].HeaderText = "Nom d'ouvrage";
                dataGridView3.Columns[6].HeaderText = "Auteur d'ouvrage";
                dataGridView3.Columns[6].HeaderText = "Editeur d'ouvrage";
                dataGridView3.Columns[6].HeaderText = "Numero d'ouvrage";
                dataGridView3.Columns[6].HeaderText = "Etat";
                dataGridView3.Columns[6].HeaderText = "Date de retour";
                dataGridView3.Columns[6].HeaderText = "Note";

                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (dataGridView1.SelectedRows[0].Cells["Id"].Value.ToString() != "")
            {
                selected_client_id = int.Parse(dataGridView1.SelectedRows[0].Cells["Id"].Value.ToString());
            }
        }
         private void dataGridView2_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (dataGridView2.SelectedRows[0].Cells["Id"].Value.ToString() != "")
            {
                selected_ouvrage_id = int.Parse(dataGridView2.SelectedRows[0].Cells["Id"].Value.ToString());
            }

        }

        private void dataGridView3_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            selected_id = int.Parse(dataGridView3.SelectedRows[0].Cells["Id"].Value.ToString());
            textBox1.Text = dataGridView3.SelectedRows[0].Cells["note"].Value.ToString();
            String DATEE = dataGridView3.SelectedRows[0].Cells["date_retour"].Value.ToString();
            DateTime date = DateTime.Parse(DATEE);
            //MessageBox.Show(dataGridView3.SelectedRows[0].Cells["date_retour"].Value.ToString());
            dateTimePicker1.Value = date;
            string selectedtype = dataGridView3.SelectedRows[0].Cells["etat"].Value.ToString();

            if (selectedtype.Equals("Dehors"))
            {
                comboBox1.SelectedIndex = 0;
            }
            else
            {
                comboBox1.SelectedIndex = 1;
            }


            button2.Enabled = true;
            button3.Enabled = true;
        }

        private void button2_Click(object sender, EventArgs e)
        {

            if (comboBox1.SelectedItem.ToString() == null || String.IsNullOrWhiteSpace(dateTimePicker1.Value.ToString())
                   || selected_client_id == null || selected_ouvrage_id == null)
            {
                label2.Text = "Remplire les information de client";
            }
            else
            {
                try
                {
                    conn = new MySqlConnection();
                    conn.ConnectionString = myConnectionString;
                    conn.Open();
                    String req = " UPDATE `emprints` SET `date_retour`=@date_retour,`etat`=@etat,`note`=@note WHERE id = @id";

                    cmd = new MySqlCommand(req, conn);

                    cmd.Parameters.AddWithValue("@date_retour", dateTimePicker1.Value);
                    cmd.Parameters.AddWithValue("@etat", comboBox1.SelectedItem.ToString());
                    cmd.Parameters.AddWithValue("@note", textBox1.Text);
                    cmd.Parameters.AddWithValue("@id", selected_id);
                    cmd.ExecuteNonQuery();
                    conn.Close();
                    displaydata();

                }
                catch (MySql.Data.MySqlClient.MySqlException ex)
                {
                    MessageBox.Show(ex.Message);
                }
            }
        }
    

    private void button3_Click(object sender, EventArgs e)
    {
        if (selected_id != null)
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
                String req = " DELETE FROM `emprints` WHERE id = @id";
                cmd = new MySqlCommand(req, conn);
                cmd.Parameters.AddWithValue("@id", selected_id);
                cmd.ExecuteNonQuery();
                conn.Close();
                displaydata();

            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
    }

    private void button1_Click(object sender, EventArgs e)
    {
        try
        {
            //errormessage
            if (comboBox1.SelectedItem.ToString() == null || comboBox1.SelectedItem.ToString() == "" || String.IsNullOrWhiteSpace(dateTimePicker1.Value.ToString())
                || selected_client_id == 0 || selected_ouvrage_id == 0)
            {
                label2.Text = "Remplire les information de client";
            }
            else
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();
                String req2 = "INSERT INTO `emprints`(`user_id`, `ouvrage_id`, `date_retour`, `etat`, `note`) VALUES " +
                " (@user_id,@ouvrage_id,@date_retour,@etat,@note)";
                cmd = new MySqlCommand(req2, conn);
                cmd.Parameters.AddWithValue("@user_id", selected_client_id);
                cmd.Parameters.AddWithValue("@ouvrage_id", selected_ouvrage_id);
                cmd.Parameters.AddWithValue("@date_retour", dateTimePicker1.Value);
                cmd.Parameters.AddWithValue("@etat", comboBox1.SelectedItem.ToString());
                cmd.Parameters.AddWithValue("@note", textBox1.Text);

                cmd.ExecuteNonQuery();
                conn.Close();
                displaydata();
            }
        }
        catch (MySql.Data.MySqlClient.MySqlException ex)
        {
            MessageBox.Show(ex.Message);
        }
    }

        private void hoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Home form = new Home();
            form.Show();

        }

        private void ouvragesToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Ouvrage form = new Ouvrage();
            form.Show();
        }

        private void usersToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Client form = new Client();
            form.Show();
        }

        private void emprintsToolStripMenuItem_Click(object sender, EventArgs e)
        {

        }
    }
}
